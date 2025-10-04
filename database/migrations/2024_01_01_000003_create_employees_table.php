<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->default('México');
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['M', 'F', 'Otro'])->nullable();
            $table->enum('marital_status', ['Soltero', 'Casado', 'Divorciado', 'Viudo', 'Unión Libre'])->nullable();
            $table->string('national_id')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            $table->date('hire_date');
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->decimal('salary', 15, 2);
            $table->enum('employment_status', ['Activo', 'Inactivo', 'Suspendido', 'Jubilado'])->default('Activo');
            $table->string('work_schedule')->default('Lunes a Viernes 8:00-17:00');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('manager_id')->references('id')->on('employees')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};

