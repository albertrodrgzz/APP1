<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employee_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->enum('document_type', [
                'Contrato',
                'DNI',
                'CURP',
                'RFC',
                'Comprobante de Domicilio',
                'Acta de Nacimiento',
                'Certificado Médico',
                'Carta de Antecedentes',
                'Otros'
            ]);
            $table->string('document_name');
            $table->string('file_path');
            $table->bigInteger('file_size');
            $table->string('mime_type');
            $table->unsignedBigInteger('uploaded_by');
            $table->boolean('is_verified')->default(false);
            $table->date('expiry_date')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_documents');
    }
};

