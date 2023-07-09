<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Vehicle;
use App\Models\Country;
class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('car_id')->unique();
            $table->string('carName');
            $table->integer('carType')->nullable()->default(0);
            $table->string('color')->nullable()->default(null);
            $table->string('year')->nullable()->default(null);
            $table->string('reg_number')->unique()->nullable()->default(null);
            $table->string('capacity')->nullable()->default(0);
            $table->unsignedBigInteger('city_id');
            $table->integer('active')->default(0);
            $table->timestamps();
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->timestamps();
        });

        Country::insert([
            [ "code" => "SA" , 'name' => 'المملكة العربية السعودية'],
            [ "code" => "ET" , 'name' => 'إثيوبيا'],
            [ "code" => "AZ" , 'name' => 'أذربيجان'],
            [ "code" => "AM" , 'name' => 'أرمينيا'],
            [ "code" => "AW" , 'name' => 'أروبا'],
            [ "code" => "ER" , 'name' => 'إريتريا'],
            [ "code" => "ES" , 'name' => 'أسبانيا'],
            [ "code" => "AU" , 'name' => 'أستراليا'],
            [ "code" => "EE" , 'name' => 'إستونيا'],
            [ "code" => "AF" , 'name' => 'أفغانستان'],
            [ "code" => "IO" , 'name' => 'إقليم المحيط الهندي البريطاني'],
            [ "code" => "EC" , 'name' => 'إكوادور'],
            [ "code" => "AR" , 'name' => 'الأرجنتين'],
            [ "code" => "JO" , 'name' => 'الأردن'],
            [ "code" => "AE" , 'name' => 'الإمارات العربية المتحدة'],
            [ "code" => "AL" , 'name' => 'ألبانيا'],
            [ "code" => "BR" , 'name' => 'البرازيل'],
            [ "code" => "PT" , 'name' => 'البرتغال'],
            [ "code" => "BA" , 'name' => 'البوسنة والهرسك'],
            [ "code" => "GA" , 'name' => 'الجابون'],
            [ "code" => "DZ" , 'name' => 'الجزائر'],
            [ "code" => "DK" , 'name' => 'الدانمارك'],
            [ "code" => "CV" , 'name' => 'الرأس الأخضر'],
            [ "code" => "PS" , 'name' => 'فلسطين'],
            [ "code" => "SV" , 'name' => 'السلفادور'],
            [ "code" => "SN" , 'name' => 'السنغال'],
            [ "code" => "SD" , 'name' => 'السودان'],
            [ "code" => "SE" , 'name' => 'السويد'],
            [ "code" => "SO" , 'name' => 'الصومال'],
            [ "code" => "CN" , 'name' => 'الصين'],
            [ "code" => "IQ" , 'name' => 'العراق'],
            [ "code" => "PH" , 'name' => 'الفلبين'],
            [ "code" => "CM" , 'name' => 'الكاميرون'],
            [ "code" => "CG" , 'name' => 'الكونغو'],
            [ "code" => "CD" , 'name' => 'الكونغو (جمهورية الكونغو الديمقراطية)'],
            [ "code" => "KW" , 'name' => 'الكويت'],
            [ "code" => "DE" , 'name' => 'ألمانيا'],
            [ "code" => "HU" , 'name' => 'المجر'],
            [ "code" => "MA" , 'name' => 'المغرب'],
            [ "code" => "MX" , 'name' => 'المكسيك'],
            [ "code" => "UK" , 'name' => 'المملكة المتحدة'],
            [ "code" => "TF" , 'name' => 'المناطق الفرنسية الجنوبية ومناطق انتراكتيكا'],
            [ "code" => "NO" , 'name' => 'النرويج'],
            [ "code" => "AT" , 'name' => 'النمسا'],
            [ "code" => "NE" , 'name' => 'النيجر'],
            [ "code" => "IN" , 'name' => 'الهند'],
            [ "code" => "US" , 'name' => 'الولايات المتحدة'],
            [ "code" => "JP" , 'name' => 'اليابان'],
            [ "code" => "YE" , 'name' => 'اليمن'],
            [ "code" => "GR" , 'name' => 'اليونان'],
            [ "code" => "AQ" , 'name' => 'أنتاركتيكا'],
            [ "code" => "AG" , 'name' => 'أنتيغوا وبربودا'],
            [ "code" => "AD" , 'name' => 'أندورا'],
            [ "code" => "ID" , 'name' => 'إندونيسيا'],
            [ "code" => "AO" , 'name' => 'أنغولا'],
            [ "code" => "AI" , 'name' => 'أنغويلا'],
            [ "code" => "UY" , 'name' => 'أوروجواي'],
            [ "code" => "UZ" , 'name' => 'أوزبكستان'],
            [ "code" => "UG" , 'name' => 'أوغندا'],
            [ "code" => "UA" , 'name' => 'أوكرانيا'],
            [ "code" => "IR" , 'name' => 'إيران'],
            [ "code" => "IE" , 'name' => 'أيرلندا'],
            [ "code" => "IS" , 'name' => 'أيسلندا'],
            [ "code" => "IT" , 'name' => 'إيطاليا'],
            [ "code" => "PG" , 'name' => 'بابوا-غينيا الجديدة'],
            [ "code" => "PY" , 'name' => 'باراجواي'],
            [ "code" => "BB" , 'name' => 'باربادوس'],
            [ "code" => "PK" , 'name' => 'باكستان'],
            [ "code" => "PW" , 'name' => 'بالاو'],
            [ "code" => "BM" , 'name' => 'برمودا'],
            [ "code" => "BN" , 'name' => 'بروناي'],
            [ "code" => "BE" , 'name' => 'بلجيكا'],
            [ "code" => "BG" , 'name' => 'بلغاريا'],
            [ "code" => "BD" , 'name' => 'بنجلاديش'],
            [ "code" => "PA" , 'name' => 'بنما'],
            [ "code" => "BJ" , 'name' => 'بنين'],
            [ "code" => "BT" , 'name' => 'بوتان'],
            [ "code" => "BW" , 'name' => 'بوتسوانا'],
            [ "code" => "PR" , 'name' => 'بورتو ريكو'],
            [ "code" => "BF" , 'name' => 'بوركينا فاسو'],
            [ "code" => "BI" , 'name' => 'بوروندي'],
            [ "code" => "PL" , 'name' => 'بولندا'],
            [ "code" => "BO" , 'name' => 'بوليفيا'],
            [ "code" => "PF" , 'name' => 'بولينزيا الفرنسية'],
            [ "code" => "PE" , 'name' => 'بيرو'],
            [ "code" => "BY" , 'name' => 'بيلاروس'],
            [ "code" => "BZ" , 'name' => 'بيليز'],
            [ "code" => "TH" , 'name' => 'تايلاند'],
            [ "code" => "TW" , 'name' => 'تايوان'],
            [ "code" => "TM" , 'name' => 'تركمانستان'],
            [ "code" => "TR" , 'name' => 'تركيا'],
            [ "code" => "TT" , 'name' => 'ترينيداد وتوباجو'],
            [ "code" => "TD" , 'name' => 'تشاد'],
            [ "code" => "CL" , 'name' => 'تشيلي'],
            [ "code" => "TZ" , 'name' => 'تنزانيا'],
            [ "code" => "TG" , 'name' => 'توجو'],
            [ "code" => "TV" , 'name' => 'توفالو'],
            [ "code" => "TK" , 'name' => 'توكيلاو'],
            [ "code" => "TO" , 'name' => 'تونجا'],
            [ "code" => "TN" , 'name' => 'تونس'],
            [ "code" => "TP" , 'name' => 'تيمور الشرقية (تيمور الشرقية)'],
            [ "code" => "JM" , 'name' => 'جامايكا'],
            [ "code" => "GM" , 'name' => 'جامبيا'],
            [ "code" => "GI" , 'name' => 'جبل طارق'],
            [ "code" => "GL" , 'name' => 'جرينلاند'],
            [ "code" => "AN" , 'name' => 'جزر الأنتيل الهولندية'],
            [ "code" => "PN" , 'name' => 'جزر البتكارين'],
            [ "code" => "BS" , 'name' => 'جزر البهاما'],
            [ "code" => "VG" , 'name' => 'جزر العذراء البريطانية'],
            [ "code" => "VI" , 'name' => 'جزر العذراء، الولايات المتحدة'],
            [ "code" => "KM" , 'name' => 'جزر القمر'],
            [ "code" => "CC" , 'name' => 'جزر الكوكوس (كيلين)'],
            [ "code" => "MV" , 'name' => 'جزر المالديف'],
            [ "code" => "TC" , 'name' => 'جزر تركس وكايكوس'],
            [ "code" => "AS" , 'name' => 'جزر ساموا الأمريكية'],
            [ "code" => "SB" , 'name' => 'جزر سولومون'],
            [ "code" => "FO" , 'name' => 'جزر فايرو'],
            [ "code" => "UM" , 'name' => 'جزر فرعية تابعة للولايات المتحدة'],
            [ "code" => "FK" , 'name' => 'جزر فوكلاند (أيزلاس مالفيناس)'],
            [ "code" => "FJ" , 'name' => 'جزر فيجي'],
            [ "code" => "KY" , 'name' => 'جزر كايمان'],
            [ "code" => "CK" , 'name' => 'جزر كوك'],
            [ "code" => "MH" , 'name' => 'جزر مارشال'],
            [ "code" => "MP" , 'name' => 'جزر ماريانا الشمالية'],
            [ "code" => "CX" , 'name' => 'جزيرة الكريسماس'],
            [ "code" => "BV" , 'name' => 'جزيرة بوفيه'],
            [ "code" => "IM" , 'name' => 'جزيرة مان'],
            [ "code" => "NF" , 'name' => 'جزيرة نورفوك'],
            [ "code" => "HM" , 'name' => 'جزيرة هيرد وجزر ماكدونالد'],
            [ "code" => "CF" , 'name' => 'جمهورية أفريقيا الوسطى'],
            [ "code" => "CZ" , 'name' => 'جمهورية التشيك'],
            [ "code" => "DO" , 'name' => 'جمهورية الدومينيكان'],
            [ "code" => "ZA" , 'name' => 'جنوب أفريقيا'],
            [ "code" => "GT" , 'name' => 'جواتيمالا'],
            [ "code" => "GP" , 'name' => 'جواديلوب'],
            [ "code" => "GU" , 'name' => 'جوام'],
            [ "code" => "GE" , 'name' => 'جورجيا'],
            [ "code" => "GS" , 'name' => 'جورجيا الجنوبية وجزر ساندويتش الجنوبية'],
            [ "code" => "GY" , 'name' => 'جيانا'],
            [ "code" => "GF" , 'name' => 'جيانا الفرنسية'],
            [ "code" => "DJ" , 'name' => 'جيبوتي'],
            [ "code" => "JE" , 'name' => 'جيرسي'],
            [ "code" => "GG" , 'name' => 'جيرنزي'],
            [ "code" => "VA" , 'name' => 'دولة الفاتيكان'],
            [ "code" => "DM" , 'name' => 'دومينيكا'],
            [ "code" => "RW" , 'name' => 'رواندا'],
            [ "code" => "RU" , 'name' => 'روسيا'],
            [ "code" => "RO" , 'name' => 'رومانيا'],
            [ "code" => "RE" , 'name' => 'ريونيون'],
            [ "code" => "ZM" , 'name' => 'زامبيا'],
            [ "code" => "ZW" , 'name' => 'زيمبابوي'],
            [ "code" => "WS" , 'name' => 'ساموا'],
            [ "code" => "SM" , 'name' => 'سان مارينو'],
            [ "code" => "PM" , 'name' => 'سانت بيير وميكولون'],
            [ "code" => "VC" , 'name' => 'سانت فينسنت وجرينادينز'],
            [ "code" => "KN" , 'name' => 'سانت كيتس ونيفيس'],
            [ "code" => "LC" , 'name' => 'سانت لوشيا'],
            [ "code" => "SH" , 'name' => 'سانت هيلينا'],
            [ "code" => "ST" , 'name' => 'ساوتوماي وبرينسيبا'],
            [ "code" => "SJ" , 'name' => 'سفالبارد وجان ماين'],
            [ "code" => "SK" , 'name' => 'سلوفاكيا'],
            [ "code" => "SI" , 'name' => 'سلوفينيا'],
            [ "code" => "SG" , 'name' => 'سنغافورة'],
            [ "code" => "SZ" , 'name' => 'سوازيلاند'],
            [ "code" => "SY" , 'name' => 'سوريا'],
            [ "code" => "SR" , 'name' => 'سورينام'],
            [ "code" => "CH" , 'name' => 'سويسرا'],
            [ "code" => "SL" , 'name' => 'سيراليون'],
            [ "code" => "LK" , 'name' => 'سيريلانكا'],
            [ "code" => "SC" , 'name' => 'سيشل'],
            [ "code" => "RS" , 'name' => 'صربيا'],
            [ "code" => "TJ" , 'name' => 'طاجيكستان'],
            [ "code" => "OM" , 'name' => 'عمان'],
            [ "code" => "GH" , 'name' => 'غانا'],
            [ "code" => "GD" , 'name' => 'غرينادا'],
            [ "code" => "GN" , 'name' => 'غينيا'],
            [ "code" => "GQ" , 'name' => 'غينيا الاستوائية'],
            [ "code" => "GW" , 'name' => 'غينيا بيساو'],
            [ "code" => "VU" , 'name' => 'فانواتو'],
            [ "code" => "FR" , 'name' => 'فرنسا'],
            [ "code" => "VE" , 'name' => 'فنزويلا'],
            [ "code" => "FI" , 'name' => 'فنلندا'],
            [ "code" => "VN" , 'name' => 'فيتنام'],
            [ "code" => "CY" , 'name' => 'قبرص'],
            [ "code" => "QA" , 'name' => 'قطر'],
            [ "code" => "KG" , 'name' => 'قيرقيزستان'],
            [ "code" => "KZ" , 'name' => 'كازاخستان'],
            [ "code" => "NC" , 'name' => 'كاليدونيا الجديدة'],
            [ "code" => "KH" , 'name' => 'كامبوديا'],
            [ "code" => "HR" , 'name' => 'كرواتيا'],
            [ "code" => "CA" , 'name' => 'كندا'],
            [ "code" => "CU" , 'name' => 'كوبا'],
            [ "code" => "CI" , 'name' => 'كوت ديفوار (ساحل العاج)'],
            [ "code" => "KR" , 'name' => 'كوريا'],
            [ "code" => "KP" , 'name' => 'كوريا الشمالية'],
            [ "code" => "CR" , 'name' => 'كوستاريكا'],
            [ "code" => "CO" , 'name' => 'كولومبيا'],
            [ "code" => "KI" , 'name' => 'كيريباتي'],
            [ "code" => "KE" , 'name' => 'كينيا'],
            [ "code" => "LV" , 'name' => 'لاتفيا'],
            [ "code" => "LA" , 'name' => 'لاوس'],
            [ "code" => "LB" , 'name' => 'لبنان'],
            [ "code" => "LI" , 'name' => 'لختنشتاين'],
            [ "code" => "LU" , 'name' => 'لوكسمبورج'],
            [ "code" => "LY" , 'name' => 'ليبيا'],
            [ "code" => "LR" , 'name' => 'ليبيريا'],
            [ "code" => "LT" , 'name' => 'ليتوانيا'],
            [ "code" => "LS" , 'name' => 'ليسوتو'],
            [ "code" => "MQ" , 'name' => 'مارتينيك'],
            [ "code" => "MO" , 'name' => 'ماكاو'],
            [ "code" => "FM" , 'name' => 'ماكرونيزيا'],
            [ "code" => "MW" , 'name' => 'مالاوي'],
            [ "code" => "MT" , 'name' => 'مالطا'],
            [ "code" => "ML" , 'name' => 'مالي'],
            [ "code" => "MY" , 'name' => 'ماليزيا'],
            [ "code" => "YT" , 'name' => 'مايوت'],
            [ "code" => "MG" , 'name' => 'مدغشقر'],
            [ "code" => "EG" , 'name' => 'مصر'],
            [ "code" => "MK" , 'name' => 'مقدونيا، جمهورية يوغوسلافيا السابقة'],
            [ "code" => "BH" , 'name' => 'مملكة البحرين'],
            [ "code" => "MN" , 'name' => 'منغوليا'],
            [ "code" => "MR" , 'name' => 'موريتانيا'],
            [ "code" => "MU" , 'name' => 'موريشيوس'],
            [ "code" => "MZ" , 'name' => 'موزمبيق'],
            [ "code" => "MD" , 'name' => 'مولدوفا'],
            [ "code" => "MC" , 'name' => 'موناكو'],
            [ "code" => "MS" , 'name' => 'مونتسيرات'],
            [ "code" => "ME" , 'name' => 'مونتينيغرو'],
            [ "code" => "MM" , 'name' => 'ميانمار'],
            [ "code" => "NA" , 'name' => 'ناميبيا'],
            [ "code" => "NR" , 'name' => 'ناورو'],
            [ "code" => "NP" , 'name' => 'نيبال'],
            [ "code" => "NG" , 'name' => 'نيجيريا'],
            [ "code" => "NI" , 'name' => 'نيكاراجوا'],
            [ "code" => "NU" , 'name' => 'نيوا'],
            [ "code" => "NZ" , 'name' => 'نيوزيلندا'],
            [ "code" => "HT" , 'name' => 'هايتي'],
            [ "code" => "HN" , 'name' => 'هندوراس'],
            [ "code" => "NL" , 'name' => 'هولندا'],
            [ "code" => "HK" , 'name' => 'هونغ كونغ SAR'],
            [ "code" => "AX" , 'name' =>  'اسلاند'],
            [ "code" => "XK" , 'name' =>  'كوسوفو'],
            [ "code" => "WF" , 'name' =>  'واليس وفوتونا'],
            [ "code" => "EH" , 'name' =>  'الصحراء الغربية'],
            [ "code" => "GB" , 'name' =>  'المملكة المتحدة'],
            [ "code" => "TL" , 'name' =>  'تيمور الشرقية'],
            [ "code" => "SS" , 'name' =>  'جنوب السودان'],
            [ "code" => "BL" , 'name' =>  'سانت بارتيليمي'],
            [ "code" => "MF" , 'name' =>  'سانت مارتن'],
        ]);

        
        Vehicle::create([
            'car_id' => '0000',
            'carName' => 'بيك أب ',
            'carType' => 2,
            'color' => 'ابيض',
            'reg_number' => '123456',
            'capacity' => 50,
            'year' => 2018,
            'city_id' => 1,
        ]);



        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('driver_id')->unique()->nullable()->default(null);
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique()->nullable()->default(null);
            $table->string('password');
            $table->string('phone')->unique()->nullable()->default(null);
            $table->string('state_num')->nullable()->default(null);
            $table->string('bank_name')->nullable()->default(null);
            $table->string('bank_num')->nullable()->default(null);
            $table->string('person_name')->nullable()->default(null); // إسم الكفيل
            $table->string('license_num')->nullable()->default(null);
            $table->string('driver_image')->nullable()->default(null); // صورة السائق
            $table->string('car_image')->nullable()->default(null); // صورة السيارة
            $table->string('license_image')->nullable()->default(null); // الرخصة
            $table->string('state_image')->nullable()->default(null); // الإقامة
            $table->string('insurance_image')->nullable()->default(null); // التامين
            $table->string('car_isemara')->nullable()->default(null); // استمارة المركبة
            $table->string('bank_card')->nullable()->default(null); // بطاقة البنك
            $table->string('account_number_image')->nullable()->default(null); // رقم الحساب
            $table->string('birthdate')->nullable()->default(null);
            $table->string('birthdate_hijri')->nullable()->default(null);
            $table->string('state_expire_date')->nullable()->default(null);
            $table->string('license_expire_date')->nullable()->default(null);
            $table->integer('license_type')->default(0); // – فئة الرخصة (خاصة *عمومي*نقل ثقيل) 
            $table->string('api_token')->nullable()->default(null);
            $table->string('device_token')->nullable()->default(null);
            $table->string('driver_lat')->nullable()->default(null);
            $table->string('driver_lon')->nullable()->default(null);
            $table->string('hours_to_work')->nullable()->default(null); // ساعات العمل على التطبيق
            $table->string('language')->nullable()->default(null);
            $table->string('type')->nullable()->default(0);
            $table->string('salary')->nullable()->default(0);
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->integer('active')->default(0);
            $table->integer('online')->default(0);
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
}
