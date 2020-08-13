<?php


namespace App\Services\RegistryItem;


use App\Services\RegistryItem\Repositories\RegistryItemRepository;
use App\Services\RegistryItem\Repositories\RegistryItemUrlRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RegistryItemService
{
    private $registryItemRepository;
    private $registryItemUrlRepository;

    private $options = [
        'includes' => [
            'registry_item_urls',
            'party'
        ]
    ];

    public function __construct(RegistryItemRepository $registryItemRepository, RegistryItemUrlRepository $registryItemUrlRepository)
    {
        $this->registryItemRepository = $registryItemRepository;
        $this->registryItemUrlRepository = $registryItemUrlRepository;
    }

    public function getItem($itemId)
    {
        return $this->registryItemRepository->getById($itemId, $this->options);
    }

    public function getItems()
    {

        if(request()->get('status') == 'unclaimed'){
            //dd(request()->get('status'));
            //return $this->registryItemRepository->getWhere('party_id', null, $this->options);
        }
        return $this->registryItemRepository->get($this->options);
    }

    public function createItem($data)
    {
        //only admins can create a meal
        $this->adminCheck();

        $registryData = [
            'name'=>Arr::get($data, 'name'),
            'description'=>Arr::get($data, 'description', null),
            'photo_src'=>Arr::get($data, 'photo_src', null),
            'party_id'=>Arr::get($data, 'party_id', null),
        ];

        $registryData['claimed_at'] = ($registryData['party_id']) ?  Carbon::now() : null;

        //lets use transactions so we can role everything back on failures
        DB::beginTransaction();
        try {

            $item = $this->registryItemRepository->create($registryData);

            if($urls = Arr::get($data, 'registry_item_urls')){

                foreach($urls as $index=>$url){
                    $this->createUrlFromData($url, $item);

                }
            }

            //if it successful commit it to the db
            DB::commit();
        }
        catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $this->getItem($item->id);
    }
    protected function createUrlFromData($url, $item)
    {
        $urlData = [
            'name'=>Arr::get($url, 'name'),
            'description'=>Arr::get($url, 'description'),
            'url'=>Arr::get($url, 'url'),
            'registry_item_id'=>$item->id,
        ];
        $this->registryItemUrlRepository->create($urlData);
    }

    public function updateItem($itemId, $data)
    {
        $item = $this->getItem($itemId);
        $updateData = [];

        DB::beginTransaction();
        try {
            //only admins can update all of a item
            if(Auth()->user()->admin == 1){
                $updateData = [
                    'name'=>Arr::get($data, 'name', $item->name),
                    'description'=>Arr::get($data, 'description', $item->description),
                    'photo_src'=>Arr::get($data, 'photo_src', $item->photo_src),
                    'party_id'=>Arr::get($data, 'party_id', $item->party_id),
                ];

                //need to check urls
                $existingUrls = [];$item->registry_item_urls->pluck('id', 'id')->toArray();

                foreach($item->registry_item_urls as $oldUrl){
                    $existingUrls[$oldUrl['id']] = $oldUrl->toArray();
                }

                $urls =  Arr::get($data, 'registry_item_urls', []);

                foreach($urls as $url){
                    $urlId = Arr::get($url, 'id', null);
                    //if its a valid url
                    if($urlId && array_key_exists($urlId, $existingUrls)){
                        $urlData = [
                            'name'=>Arr::get($url, 'name', $existingUrls[$urlId]['name']),
                            'description'=>Arr::get($url, 'description', $existingUrls[$urlId]['description']),
                            'url'=>Arr::get($url, 'url',  $existingUrls[$urlId]['url']),
                        ];
                        $this->registryItemUrlRepository->update($urlId, $urlData);
                        unset($existingUrls[$urlId]);
                    }
                    elseif(is_null($urlId)){
                        $this->createUrlFromData($url, $item);
                    }
                }
                //need to delete any urls not updated or created
                foreach ($existingUrls as $oldUrl){
                    $this->registryItemUrlRepository->delete($oldUrl->id);
                }
            }
            else{

                //basic users can only claim item, need to set party id to current users party
                $updateData = [
                    'party_id'=>(Arr::get($data, 'party_id') && ! is_null($data['party_id'])) ? Auth()->user()->party_id : null,
                ];

            }

            if($updateData['party_id'] && is_null($item->claimed_at)){
                $registryData['claimed_at'] = Carbon::now();
            }
            elseif(is_null($updateData['party_id']) && $item->claimed_at){
                $registryData['claimed_at'] = null;
            }

            $this->registryItemRepository->update($itemId, $updateData);

            //if it successful commit it to the db
            DB::commit();
        }
        catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }


        return $this->getItem($itemId);
    }
    public function deleteItem($itemId)
    {
        //only admins can delete an item
        $this->adminCheck();
        return $this->registryItemRepository->delete($itemId);
    }

    protected function adminCheck()
    {
        if(Auth()->user()->admin != 1){
            redirect(403);
        }
    }
}
