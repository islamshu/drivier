<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Panishment;
class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('panishments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable()->default(null);
            $table->string('ftime')->nullable()->default(null);
            $table->string('stime')->nullable()->default(null);
            $table->string('ttime')->nullable()->default(null);
            $table->string('amount')->nullable()->default(null);
            $table->string('block_user')->nullable()->default(0);
            $table->timestamps();
        });

        Panishment::insert([
            [
                'title' => 'محاولة احتيال',
                'ftime' => 'غرامة 2000 ريال + فصل نهائي',
                'stime' => null,
                'ttime' => null,
                'block_user' => 0,
            ],
            [
                'title' => 'التلاعب بالنظام لتحقيق نسبة قبول  عالية بدون توصيل الطلبات',
                'ftime' => 'غرامة 500 ريال للموظف  + ايقاف الحساب 24 ساعة',
                'stime' => 'غرامة 1000 ريال للموظف + ايقاف الحساب 48 ساعة',
                'ttime' => 'غرامة 1500 ريال للموظف  + اغلاق الحساب',
                'block_user' => 24,
            ],
            [
                'title' => 'توصيل الطلبات في حالة سيئة (تالفة) بارد \ غير مغلف \ في الوقت بدون حفظ جيد \ في وقت متاخر',
                'ftime' => 'قيمة الطلب (اذا فسد) + رسوم التوصيل  +غرامة 200 ريال',
                'stime' => 'قيمة الطلب (اذا فسد) +رسوم التوصيل + غرامة 300 ريال  +ايقاف الحساب 24 ساعة',
                'ttime' => 'قيمة الطلب (اذا فسد) + رسوم التوصيل + غرامة 1000 ريال + ايقاف الحساب 72 ساعة',
                'block_user' => 24,
            ],
            [
                'title' => 'رفض توصيل الطلب بدون سبب وجيه',
                'ftime' => 'قيمة الطلب  + رسوم التوصيل + غرامة 100 ريال',
                'stime' => 'قيمة الطلب + رسوم التوصيل + غرامة 500 ريال + ايقاف الحساب 24 ساعة',
                'ttime' => 'قيمة الطلب  +رسوم التوصيل + غرامة 500 ريال + ايقاف الحساب 72 ساعة',
                'block_user' => 24,
            ],
            [
                'title' => 'الطلب من العميل الغاء الطلب',
                'ftime' => 'قيمة الطلب  +رسوم التوصيل + غرامة 1000 ريال + ايقاف الحساب يشكل نهائي',
                'stime' => null,
                'ttime' => null,
                'block_user' => 0,
            ],
            [
                'title' => 'عدم النزول من السيارة و  الطلب حسب البرتوكول المتفق عليه',
                'ftime' => 'غرامة 100 ريال للموظف',
                'stime' => 'غرامة 200 ريال للموظف +ايقاف الحساب 24 ساعة',
                'ttime' => 'غرامة 500 ريال للموظف   +ايقاف الحساب 72 ساعة',
                'block_user' => 24,
            ],
            [
                'title' => 'اتمام الطلب دون التسليم للعميل لتحصيل رسوم التوصيل من التطبيق   (احتيال على النظام)',
                'ftime' => 'غرامة 1000 ريال للموظف  + ايقاف نهائي',
                'stime' => null,
                'ttime' => null,
                'block_user' => 0,
            ],
            [
                'title' => 'عدم تواجد صرف مع السائق',
                'ftime' => 'غرامة 100 ريال للموظف',
                'stime' => 'غرامة 200 ريال للموظف',
                'ttime' => 'غرامة 500 ريال للموظف +ايقاف الحساب 24 ساعة',
                'block_user' => 24,
            ],
            [
                'title' => 'التأخير في تسليم الطلب متعمد',
                'ftime' => 'غرامة 500 ريال للموظف',
                'stime' => 'غرامة 1000 ريال للموظف + ايقاف الحساب 24 ساعة',
                'ttime' => 'غرامة 1500 ريال للموظف  + ايقاف الحساب بشكل نهائي',
                'block_user' => 24,
            ],
            [
                'title' => 'سلوك سيئ',
                'ftime' => 'غرامة 300 ريال',
                'stime' => 'غرامة 500 ريال للموظف + ايقاف الحساب 24 ساعة',
                'ttime' => 'غرامة 1000 ريال للموظف + ايقاف الحساب بشكل نهائي',
                'block_user' => 24,
            ],
            [
                'title' => 'عدم ارتداء الزي الرسمي للعمل  (تي شرت لون اللوجو – بنطال اسود – كاب) يحدد الزي الكامل مره كل عام',
                'ftime' => 'غرامة 100 ريال',
                'stime' => 'غرامة 300 ريال',
                'ttime' => 'غرامة 500 ريال',
                'block_user' => 1,
            ],
            [
                'title' => 'وجود شكاوي من العميل على السيارة',
                'ftime' => 'غرامة 100 ريال',
                'stime' => 'غرامة 300 ريال',
                'ttime' => 'غرامة 500 ريال',
                'block_user' => 1,
            ],
            [
                'title' => 'عدم نظافة المركبة ( السيارة – الموتوسكل)',
                'ftime' => 'غرامة 100 ريال',
                'stime' => 'غرامة 300 ريال',
                'ttime' => 'غرامة 500 ريال',
                'block_user' => 1,
            ],
            [
                'title' => 'فقدان مفتاح المركبة',
                'ftime' => 'غرامة 500 ريال',
                'stime' => 'غرامة 1000 ريال',
                'ttime' => 'غرامة 1500 ريال',
                'block_user' => 1,
            ],
            [
                'title' => 'ترك المركبة بشكل غير امن و مفتوحة',
                'ftime' => 'غرامة 1000 ريال',
                'stime' => 'غرامة 1500 ريال',
                'ttime' => 'غرامة 2000 ريال + ايقاف بشكل نهائي',
                'block_user' => 0,
            ],
            [
                'title' => 'التدخين داخل المركبة',
                'ftime' => 'غرامة 150 ريال',
                'stime' => 'غرامة 300 ريال',
                'ttime' => 'غرامة 500 ريال + ايقاف الحساب 24 ساعة',
                'block_user' => 24,
            ],
            [
                'title' => 'الانتظار بشكل خاطىء',
                'ftime' => 'غرامة 300 ريال',
                'stime' => 'غرامة 500 ريال',
                'ttime' => 'غرامة 1000 ريال + ايقاف الحساب 72 ساعة',
                'block_user' => 24,
            ],
            [
                'title' => 'تلفيات المركبة',
                'ftime' => 'قيمة الاصلاحات',
                'stime' => 'قيمة الاصلاحات + غرامة 500 ريال',
                'ttime' => 'قيمة الاصلاحات + غرامة 1000 ريال + ايقاف الحساب 72 ساعة',
                'block_user' => 0,
            ],
            [
                'title' => 'السماح لاخر غير مفوض لركوب المركبة',
                'ftime' => 'غرامة 300 ريال',
                'stime' => 'غرامة 500 ريال',
                'ttime' => 'غرامة 1000 ريال',
                'block_user' => 0,
            ],
            [
                'title' => 'المخالفات تحمل على المتسبب',
                'ftime' => 'غرامة 300 ريال',
                'stime' => 'غرامة 500 ريال',
                'ttime' => 'غرامة 1000 ريال',
                'block_user' => 0,
            ],
            [
                'title' => 'عدم التواجد لتلبية طلبات العميل يحمل بتكلفة ايجار السيارة عن فترات عدم التواجد',
                'ftime' => 'تكلفة ايجار السيارة + غرامة 100 ريال',
                'stime' => 'تكلفة ايجار السيارة + غرامة 300 ريال',
                'ttime' => 'تكلفة ايجار السيارة + غرامة 500 ريال',
                'block_user' => 0,
            ],
            [
                'title' => 'فقدان المعدات و الادوات الخاصة بالشركة',
                'ftime' => 'تكلفة الادوات و المعدات  + غرامة 100 ريال',
                'stime' => 'تكلفة الادوات و المعدات  + غرامة 300 ريال',
                'ttime' => 'تكلفة الادوات و المعدات  + غرامة 500 ريال',
                'block_user' => 0,
            ],


        ]);

        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('panishment_id');
            $table->timestamps();
            $table->foreign('driver_id')
                ->references('id')->on('drivers')
                ->onDelete('cascade');
            $table->foreign('panishment_id')
                ->references('id')->on('panishments')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
