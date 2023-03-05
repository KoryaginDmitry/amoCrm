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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->integer('amo_crm_id');
            $table->string('name');
            $table->integer('responsibleUserId');
            $table->integer('groupId');
            $table->integer('createdBy');
            $table->integer('updatedBy');
            $table->integer('createdAt');
            $table->integer('updatedAt');
            $table->integer('accountId');
            $table->integer('pipelineId');
            $table->integer('statusId');
            $table->integer('closedAt')->nullable();
            $table->integer('closestTaskAt')->nullable();
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};

  #lossReasonId: null
  #lossReason: null
  #isDeleted: false
  #tags: null
  #sourceId: null
  #sourceExternalId: null
  #customFieldsValues: null
  #score: null
  #isPriceModifiedByRobot: null
  #contacts: null
  #company: null
  #catalogElementsLinks: null
  #visitorUid: null
  #metadata: null
  #complexRequestIds: null
  #isMerged: null
  #requestId: null
