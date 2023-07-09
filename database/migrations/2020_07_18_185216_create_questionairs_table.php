<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Questionair;
class CreateQuestionairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionairs', function (Blueprint $table) {
            $table->id();
            $table->string('question_en');
            $table->string('question_ar');
            $table->timestamps();
        });
        Questionair::insert([
            [
                'question_en' => 'Appearance',
                'question_ar' => 'المظهر',
            ],
            [
                'question_en' => 'Speed of delivery',
                'question_ar' => 'سرعة التوصيل	',
            ],
            [
                'question_en' => 'Dealing',
                'question_ar' => 'التعامل',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionairs');
    }
}
