<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();  // Cột id tự động tăng
            $table->string('fullname');  // Cột lưu tên đầy đủ
            $table->string('username')->unique();  // Cột tên đăng nhập, duy nhất
            $table->string('email')->unique();  // Cột email, duy nhất
            $table->string('phone');  // Cột số điện thoại
            $table->string('address')->nullable();  // Cột địa chỉ
            $table->date('birthday')->nullable();  // Cột ngày sinh
            $table->enum('gender', ['male', 'female']);  // Cột giới tính
            $table->string('avatar')->nullable();  // Cột avatar (đường dẫn đến ảnh)
            $table->string('password');  // Cột mật khẩu (đã mã hóa)
            $table->enum('role', ['user', 'admin'])->default('user');  // Cột vai trò (user hoặc admin)
            $table->timestamps();  // Cột thời gian tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
