<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_admin', function (Blueprint $table) {
            $table->bigIncrements('adminId');
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('tbl_users', function (Blueprint $table) {
            $table->bigIncrements('userId');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('activation_token', 100)->nullable();
            $table->boolean('isActive')->default(false);
            $table->string('google_id')->nullable();
            $table->string('fullName')->nullable();
            $table->string('avatar')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_tours', function (Blueprint $table) {
            $table->bigIncrements('tourId');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('time')->nullable();
            $table->string('destination')->nullable();
            $table->unsignedInteger('quantity')->default(0);
            $table->decimal('priceAdult', 12, 2)->default(0);
            $table->decimal('priceChild', 12, 2)->default(0);
            $table->string('domain', 10)->nullable();
            $table->boolean('availability')->default(false);
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_images', function (Blueprint $table) {
            $table->bigIncrements('imageId');
            $table->unsignedBigInteger('tourId');
            $table->string('imageURL')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->index('tourId');
        });

        Schema::create('tbl_temp_images', function (Blueprint $table) {
            $table->bigIncrements('tempImageId');
            $table->unsignedBigInteger('tourId')->nullable();
            $table->string('imageTempURL')->nullable();
            $table->timestamps();
            $table->index('tourId');
        });

        Schema::create('tbl_timeline', function (Blueprint $table) {
            $table->bigIncrements('timelineId');
            $table->unsignedBigInteger('tourId');
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->index('tourId');
        });

        Schema::create('tbl_booking', function (Blueprint $table) {
            $table->bigIncrements('bookingId');
            $table->unsignedBigInteger('tourId');
            $table->unsignedBigInteger('userId')->nullable();
            $table->string('address')->nullable();
            $table->string('fullName')->nullable();
            $table->string('email')->nullable();
            $table->unsignedInteger('numAdults')->default(0);
            $table->unsignedInteger('numChildren')->default(0);
            $table->string('phoneNumber')->nullable();
            $table->decimal('totalPrice', 12, 2)->default(0);
            $table->string('bookingStatus', 10)->default('p');
            $table->dateTime('bookingDate')->nullable();
            $table->timestamps();
            $table->index('tourId');
            $table->index('userId');
        });

        Schema::create('tbl_checkout', function (Blueprint $table) {
            $table->bigIncrements('checkoutId');
            $table->unsignedBigInteger('bookingId');
            $table->string('paymentMethod')->nullable();
            $table->decimal('amount', 12, 2)->default(0);
            $table->string('paymentStatus', 10)->default('n');
            $table->string('transactionId')->nullable();
            $table->timestamps();
            $table->index('bookingId');
        });

        Schema::create('tbl_reviews', function (Blueprint $table) {
            $table->bigIncrements('reviewId');
            $table->unsignedBigInteger('tourId');
            $table->unsignedBigInteger('userId');
            $table->text('comment')->nullable();
            $table->unsignedTinyInteger('rating')->default(0);
            $table->timestamp('timestamp')->nullable();
            $table->timestamps();
            $table->index(['tourId', 'userId']);
        });

        Schema::create('tbl_contact', function (Blueprint $table) {
            $table->bigIncrements('contactId');
            $table->string('fullName')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('email')->nullable();
            $table->text('message')->nullable();
            $table->boolean('isReply')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_contact');
        Schema::dropIfExists('tbl_reviews');
        Schema::dropIfExists('tbl_checkout');
        Schema::dropIfExists('tbl_booking');
        Schema::dropIfExists('tbl_timeline');
        Schema::dropIfExists('tbl_temp_images');
        Schema::dropIfExists('tbl_images');
        Schema::dropIfExists('tbl_tours');
        Schema::dropIfExists('tbl_users');
        Schema::dropIfExists('tbl_admin');
    }
};
