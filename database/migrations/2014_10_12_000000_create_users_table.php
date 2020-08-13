<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * php artisan user:create --first_name=Parker --last_name=Dell --email=parkerdell94@gmail.com --password=testtest --admin=1
     * php artisan user:get --id=2
     * @return void
     */
    public function up()
    {
        Schema::create('party', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('slug');
            $table->string('email')->unique()->nullable();
            $table->string('street')->nullable();
            $table->string('street2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->default('USA');
            $table->boolean('rehearsal')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('rsvps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('party_id');
            $table->integer('count');
            $table->boolean('attending')->nullable();
            $table->boolean('rehearsal')->nullable();
            $table->boolean('ceremony')->nullable();
            $table->boolean('reception')->nullable();
            $table->boolean('response_may_change')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token', 80);
            $table->string('allergies')->nullable();
            $table->integer('party_id')->nullable();
            $table->boolean('party_lead')->default(1);
            $table->boolean('admin')->default(0);
            $table->integer('meal_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('meals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('gluten_free')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_meal_preferences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('meal_id');
            $table->boolean('gluten_free')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        $meals = [
            ['name'=>'Chicken', 'gluten_free'=>0, 'description'=>'Spring Chicken Dish with mushrooms and onions'],
            ['name'=>'Beef', 'gluten_free'=>0, 'description'=>'Roasted Beef served with ...'],
            ['name'=>'Vegies', 'gluten_free'=>0, 'description'=>'Vegi Lasagna'],
        ];

        foreach ($meals as $meal){
            DB::table('meals')->insert($meal);
        }

        Schema::create('registry_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('photo_src')->nullable();
            $table->integer('party_id')->nullable();
            $table->boolean('unlimited_claims')->nullable();
            $table->dateTime('claimed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('registry_items_urls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('registry_item_id');
            $table->string('url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('party');
        Schema::dropIfExists('rsvps');
        Schema::dropIfExists('meals');
        Schema::dropIfExists('user_meal_preferences');
        Schema::dropIfExists('registry_items');
        Schema::dropIfExists('registry_items_urls');
    }
}
