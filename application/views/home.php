<?php
if ($this->session->flashdata('logout') != NULL) {
    echo '<h5 class="alert alert-info">' . $this->session->flashdata('logout') . '</h5>';
}
if ($this->session->flashdata('login_error') != NULL) {
    echo '<h5 class="alert alert-danger">' . $this->session->flashdata('login_error') . '</h5>';
}
if ($this->session->flashdata('signup_fail') != NULL) {
    echo '<h5 class="alert alert-danger">' . $this->session->flashdata('signup_fail') . '</h5>';
}
?>
<div>
    <h3>
        <center>About Us</center>
    </h3>
</div>

<div class="container">
    <div class="row" style="font-size:18px; font-family:times new roman;">
        <div class="col-sm-6" style="text-align:justify;text-justify: inter-word;">
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                software like Aldus PageMaker including versions of Lorem Ipsum.
                It is a long established fact that a reader will be distracted by the readable content of a page when
                looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution
                of letters, as opposed to using 'Content here, content here', making it look like readable English.
            </p>
            <p>
                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical
                Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at
                Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a
                Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the
                undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et
                Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the
                theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor
                sit amet..", comes from a line in section 1.10.32.
            </p>
        </div>
        <div class="col-sm-6" dir="rtl" style="text-align:justify;text-justify: inter-word;">
            <p>
                لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات
                المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة
                مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف.
                خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد
                الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق "ليتراسيت" (Letraset) البلاستيكية تحوي
                مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل "ألدوس بايج مايكر"
                (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.
            </p>
            <p>
                عام خیال کے برعکس، Lorem Ipsum صرف بے ترتیب متن نہیں ہے. یہ پرانے 2000 سال کے دوران اس کے بنانے میں 45
                قبل مسیح سے کلاسیکی لاطینی ادب کا ایک ٹکڑا میں جڑیں ہیں،. رچرڈ McClintock، ورجینیا میں Hampden-سڈنی کالج
                میں لاطینی پروفیسر، ایک نہیں Lorem Ipsum گزرنے سے، زیادہ غیر واضح لاطینی الفاظ، کونسیکٹٹور میں سے ایک کو
                دیکھا، اور کلاسیکی ادب میں لفظ کے حوالہ دیا ذریعے جا، undoubtable منبع دریافت کیا. نہیں Lorem Ipsum حصوں
                1.10.32 اور 1.10.33 سے آتا ہے "ڈی Finibus Bonorum یٹ Malorum" سسرو کی طرف سے (خیر و شر کے غلو)، 45 قبل
                مسیح میں لکھا گیا. یہ کتاب پنرجہرن کے دوران بہت مقبول اخلاقیات کے اصول، پر ایک رسالہ ہے. نہیں Lorem
                Ipsum کی پہلی لائن، "Lorem ipsum dolor دھرنا دھرنا amet .."، سیکشن 1.10.32 میں ایک لائن سے آتا ہے.

                1500s کے بعد سے استعمال کیا Lorem Ipsum کے معیاری حصہ دلچسپی ان لوگوں کے لئے ذیل میں پیش کیا جاتا ہے.
                حصے 1.10.32 اور سسرو طرف 1.10.33 "ڈی Finibus Bonorum یٹ Malorum" سے بھی، ان کے عین مطابق اصل شکل میں پیش
                کی H. Rackham کی طرف سے 1914 ترجمہ انگریزی ورژن کے ساتھ ہیں.
            </p>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-sm-4">
            <img class="img-circle img-responsive img-center" src="<?php echo base_url(); ?>assets/dist/img/300x300.png"
                 alt="" height="210" width="250">
            <h4>Image 1</h4>
            <p>These marketing boxes are a great place to put some information. </p>
        </div>
        <div class="col-sm-4">
            <img class="img-circle img-responsive img-center" src="<?php echo base_url(); ?>assets/dist/img/300x300.png"
                 alt="" height="210" width="250">
            <h4>Image 2</h4>
            <p>The images are set to be circular and responsive. </p>
        </div>
        <div class="col-sm-4">
            <img class="img-circle img-responsive img-center" src="<?php echo base_url(); ?>assets/dist/img/300x300.png"
                 alt="" height="210" width="250">
            <h4>Image 3</h4>
            <p>Donec id elit non mi porta gravida at eget metus.</p>
        </div>
    </div>
</div>

<hr>