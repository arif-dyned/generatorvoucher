<?php $__env->startSection('header_script'); ?>
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }

    button:focus {
        outline: 0;
    }

    .warning {
        color: #ff5858;
        display: none;
    }
    .disNon{
      display: none !important;
    }
    #progress__bar li.yellow:before, #progress__bar li.yellow:after {
      background: transparent;
      color: #F7F052;
      -webkit-transition: all 2s;
      transition: all 2s;
    }
</style>
<?php $__env->stopSection(); ?>

<div class="stars"></div>
        <div class="stars2"></div>
        <div class="stars3"></div>
        <!-- modal section -->
        <section class="modalSocial" id="modalSocial" style="display: none">
            <div class="modalSocial__content">
                <div class="modal--box">
                    <section class="box__assessment">
                        <span class="close closeModal">&times;</span>
                        <h2 class="white-text text-center">
                                share your score with your friends
                            </h2>
                        <button class="neobutton"><span class="fa fa-facebook"></span></button>
                        <button class="neobutton"><span class="fa fa-twitter"></span></button>
                        <button class="neobutton"><span class="fa fa-linkedin"></span></button>
                    </section>
                </div>
            </div>
        </section>
        <!-- modal end -->
        <!-- modal sign in -->
        <section class="modalSocial" id="modalSignin" style="display: none">
            <div class="modalSocial__content">
                <div class="modal--box">
                    <section class="box__assessment">
                        <span class="close closeModal">&times;</span>
                        <div class="assignup">
                            <!-- <div class="signup__title">
                                Sign up
                            </div> -->
                            <div class="signup__form">
                                <div class="field">
                                    <label class="label">Email</label>
                                    <p class="control">
                                        <input class="input" type="email" placeholder="Neo@dyned.com" id="loginEmail">
                                    </p>
                                </div>
                                <div class="field">
                                    <label class="label">Password</label>
                                    <p class="control">
                                        <input class="input" type="password" placeholder="*****" id="loginPassword">
                                    </p>
                                </div>
                                <div class="phone__text" style="color: #ff5858;display: none;position: absolute;" id="alert-logIn">
                                    All fields are required
                                </div>
                                <div class="phone__text" style="color: #ff5858;display: none;position: absolute;" id="alert-logInemail">
                                    Not a valid email address
                                </div>
                            </div>
                            <button class="neobutton" id="signIn">SIGN IN</button>
                        </div>
                    </section>
                </div>
            </div>
        </section>
        <!-- modal sign in end -->
        <!-- modal ASSESSMENT START -->
        <section class="modalSocial" id="modalAssessment" style="display: none">
            <div class="modalSocial__content">
                <div class="modal--box">
                    <section class="box__assessment">
                        <span class="close closeModal">&times;</span>
                        <div class="content__introduction">
                            <div class="content__introduction--image">
                                <img src="assets/img/test_icon.svg">
                            </div>
                            <div class="content__introduction--text">
                                <p style="text-align: left;"> This test has two sections - one listening and one reading. You will have up to 20 minutes for complete your test. </p>
                                <br>
                                <p style="text-align: left;"><strong>REMEMBER:</strong></p>
                                <br>
                                <ul style="text-align: left;">
                                <li>Read all instructions carefully.</li>
                                <li>Pace yourself to avoid running out of time.</li>
                                <li>If you are not sure of an answer, make the best possible choice or move on to the next question.</li>
                                </ul>
                                <button class="neobutton text-center startAssess" >START ASSESSMENT</button>

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
        <!-- modal ASSESSMENT START end -->
        <div class="wrapper">
            <div class="timer__assessment"><span class="countDownAssess"></span></div>
            <header class="columns">
                <div class="navcenter">
                    <a href="#"><img class="navcenter__neo" src="assets/img/logo neo.png" style="height: 40px; align-self: center;"></a>
                </div>
                <nav class="navright">
                    <ul class="navright__ul">
                        <li class="navright__ul--li toggleSignin hideSignIn"><a>Sign in</a>
                        </li>
                    </ul>
                </nav>
            </header>
            <div class="progresss">
                <div class="progress__title">
                    <span class="spanactive" id="topAsses">Assessment</span>
                    <span id="topRegis">Registration</span>
                    <span id="topGoal">Set your Goal</span>
                    <span id="topPack">Select Package</span>
                    <span id="topPay">Payment</span>
                </div>
                <ul id="progress__bar">
                    <li id="numProg1"></li>
                    <li id="numProg2"></li>
                    <li id="numProg3"></li>
                    <li id="numProg4"></li>
                    <li id="numProg5"></li>
                </ul>
            </div>
            <!--  ============== LIVE PORTAL ============== -->
            <div class="liveportalsec">
                <!-- //First journey -->
                <div class="sectionbox">
                    <section class="box__assessment" style="min-height: 500px;">
                        <div class="assignup">
                            <div class="signup__title">
                                <img src="assets/img/NeoForm.png">
                            </div>
                        </div>
                        <div class="title-white-bold text-center spaces">
                            nextgen english online
                        </div>
                        <button class="neobutton next" id="startJourney">START YOUR JOURNEY</button>
                        <button class="neobutton__white toggleSignin">SIGN IN</button>
                        <button class="neobutton__white next">WATCH</button>
                    </section>
                </div>
                <!--  ==============A S S E S S M E N T============== -->
                <div class="sectionbox" name="q_txt_opt_txt" id="q_txt_opt_txt">
                    <section class="box__assessment">
                        <div class="box__answer--text">
                            <div class="box__assessment--ques">
                                Rather than take a higher paying job with a large companny, she decided to work her way up within a smaller company.
                            </div>
                            <div class="box__assessment--answer">
                                how old is simon when his parents buy him his first camera ?
                            </div>
                            <div class="box__assessment--answer">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus voluptatem, impedit repudiandae accusantium itaque tenetur ut distinctio nihil facilis quas officiis, adipisci sit, dolore, id cupiditate deleniti recusandae magnam. Modi.
                            </div>
                            <div class="box__assessment--answer">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem ullam, quaerat odio iusto aliquid ipsam.
                            </div>
                            <div class="box__assessment--answer">
                                how old is simon when his parents buy him his first camera ?
                            </div>
                        </div>
                        <button class="neobutton next">NEXT</button>
                    </section>
                </div>
                <!--  ==============A S S E S S M E N T with images ============== -->
                <div class="sectionbox" id="q_txt_opt_img">
                    <section class="box__assessment" name="q_txt_opt_img">
                        <div class="assessment__image--ques">
                            Rather than take a higher paying job with a large companny, she decided to work her way up within a smaller company.
                        </div>
                        <div class="image__assessment">
                            <div class="image__assessment--answer">
                                <img src="assets/img/questionimg/1vbag.png">
                            </div>
                            <div class="image__assessment--answer">
                                <img src="assets/img/questionimg/1vbook.png">
                            </div>
                            <div class="image__assessment--answer">
                                <img src="assets/img/questionimg/1vchair.png">
                            </div>
                            <div class="image__assessment--answer">
                                <img src="assets/img/questionimg/1vdesk.png">
                            </div>
                        </div>
                        <button class="neobutton next">NEXT</button>
                    </section>
                </div>
                <!-- text__question__image__answer -->
                <!-- image__question__text__answer -->
                <div class="sectionbox" id="q_img_txt_opt_txt">
                    <section class="box__assessment" name="q_img_txt_opt_txt">
                        <div class="tab__justify">
                            <div class="image__assessment--question">
                                <img src="assets/img/questionimg/1vbag.png">
                            </div>
                            <div class="box__answer--text">
                                <div class="box__assessment--ques">
                                    Rather than take a higher paying job with a large companny, she decided to work her way up within a smaller company.
                                </div>
                                <div class="box__assessment--answer">
                                    how old is simon when his parents buy him his first camera ?
                                </div>
                                <div class="box__assessment--answer">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus voluptatem, impedit repudiandae accusantium itaque tenetur ut distinctio nihil facilis quas officiis, adipisci sit, dolore, id cupiditate deleniti recusandae magnam. Modi.
                                </div>
                                <div class="box__assessment--answer">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem ullam, quaerat odio iusto aliquid ipsam.
                                </div>
                                <div class="box__assessment--answer">
                                    how old is simon when his parents buy him his first camera ?
                                </div>
                            </div>
                        </div>
                        <button class="neobutton next">NEXT</button>
                    </section>
                </div>
                <!-- QUESTION AUDIO OPTION TEXT -->
                <div class="sectionbox" id="q_audio_opt_txt">
                    <section class="box__assessment" name="q_audio_opt_txt">
                        <div class="audio__assessment--question">
                            <a class="play fa fa-play" onclick="bgmPlay()"></a>
                            <audio id="bgm">
                                <source src="assets/audio/050_001_103330.mp3" type="audio/mpeg" />
                            </audio>
                            <div class="box__answer--text">
                                <div class="box__assessment--answer">
                                    how old is simon when his parents buy him his first camera ?
                                </div>
                                <div class="box__assessment--answer">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus voluptatem, impedit repudiandae accusantium itaque tenetur ut distinctio nihil facilis quas officiis, adipisci sit, dolore, id cupiditate deleniti recusandae magnam. Modi.
                                </div>
                                <div class="box__assessment--answer">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem ullam, quaerat odio iusto aliquid ipsam.
                                </div>
                                <div class="box__assessment--answer">
                                    how old is simon when his parents buy him his first camera ?
                                </div>
                            </div>
                        </div>
                        <button class="neobutton next">NEXT</button>
                    </section>
                </div>
                <!-- QUESTION AUDIO OPTION IMAGE -->
                <div class="sectionbox" id="q_audio_opt_txt">
                    <section class="box__assessment" name="q_audio_opt_txt">
                        <div class="audio__assessment--question">
                            <a class="play fa fa-play" onclick="bgmPlay()"></a>
                            <audio id="bgm">
                                <source src="assets/audio/050_001_103330.mp3" type="audio/mpeg" />
                            </audio>
                            <div class="image__assessment">
                                <div class="image__assessment--answer">
                                    <img src="assets/img/questionimg/1vbag.png">
                                </div>
                                <div class="image__assessment--answer">
                                    <img src="assets/img/questionimg/1vbook.png">
                                </div>
                                <div class="image__assessment--answer">
                                    <img src="assets/img/questionimg/1vchair.png">
                                </div>
                                <div class="image__assessment--answer">
                                    <img src="assets/img/questionimg/1vdesk.png">
                                </div>
                            </div>
                        </div>
                        <button class="neobutton next">NEXT</button>
                    </section>
                </div>
                <!-- QUESTION AUDIO and text OPTION IMAGE -->
                <div class="sectionbox" id="q_audio_txt_opt_txt">
                    <section class="box__assessment" name="q_audio_opt_txt">
                        <div class="audio__assessment--question">
                            <a class="play fa fa-play" onclick="bgmPlay()"></a>
                            <audio id="bgm">
                                <source src="assets/audio/050_001_103330.mp3" type="audio/mpeg" />
                            </audio>
                            <div class="box__answer--text">
                                <div class="box__assessment--ques">
                                    Rather than take a higher paying job with a large companny, she decided to work her way up within a smaller company.
                                </div>
                                <div class="box__assessment--answer">
                                    how old is simon when his parents buy him his first camera ?
                                </div>
                                <div class="box__assessment--answer">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus voluptatem, impedit repudiandae accusantium itaque tenetur ut distinctio nihil facilis quas officiis, adipisci sit, dolore, id cupiditate deleniti recusandae magnam. Modi.
                                </div>
                                <div class="box__assessment--answer">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem ullam, quaerat odio iusto aliquid ipsam.
                                </div>
                                <div class="box__assessment--answer">
                                    how old is simon when his parents buy him his first camera ?
                                </div>
                            </div>
                        </div>
                        <button class="neobutton next" id="lastAssess">NEXT</button>
                    </section>
                </div>
                <!-- results section -->
                <div class="sectionbox">
                    <section class="box__assessment">
                        <div class="pt">
                            <div class="pt__title spaces">
                                <h2 class="white-text" style="margin:0">Congratulations! <br>
                                You are a</h2>
                            </div>
                            <div class="pt__image spaces">
                                <img src="assets/img/PlanetCertification/Starter.png">
                            </div>
                            <div class="progress">
                                <div class="circle" id="progress1">
                                    <span class="label">Starter</span>
                                </div>
                                <span class="bar" id="abar1"></span>
                                <div class="circle" id="progress2">
                                    <span class="label">A1</span>
                                </div>
                                <span class="bar" id="abar2"></span>
                                <div class="circle" id="progress3">
                                    <span class="label">A2</span>
                                </div>
                                <span class="bar" id="abar3"></span>
                                <div class="circle" id="progress4">
                                    <span class="label">B1</span>
                                </div>
                                <span class="bar" id="abar4"></span>
                                <div class="circle" id="progress5">
                                    <span class="label">B2</span>
                                </div>
                                <span class="bar" id="abar5"></span>
                                <div class="circle" id="progress6">
                                    <span class="label">C1</span>
                                </div>
                            </div>
                            <!-- <div class="progresss spaces">
                                <ul id="result">
                                    <li id="progress1" class="">
                                        <p>Starter</p>
                                    </li>
                                    <li id="progress2" class="">
                                        <p>A1</p>
                                    </li>
                                    <li id="progress3" class="">
                                        <p>A2</p>
                                    </li>
                                    <li id="progress4" class="">
                                        <p>B1</p>
                                    </li>
                                    <li id="progress5" class="">
                                        <p>B2</p>
                                    </li>
                                    <li id="progress6" class="">
                                        <p>C1</p>
                                    </li>
                                </ul>
                            </div>
                        </div> -->
                        </div>
                        <button class="neobutton next" id="next-result">CONTINUE</button>
                        <button class="neobutton" id="toggleCertificate">SHARE</button>
                    </section>
                </div>
                <!-- sign in -->
                <div class="sectionbox">
                    <section class="box__assessment">
                        <div class="assignup">
                            <!-- <div class="signup__title">
                                    Sign up
                                </div> -->
                            <div class="signup__form">
                                <div class="field upload">
                                    <p class="control control__upload">
                                        <img class="image__upload imageUp" id="imageUp" src="assets/img/nm.png">
                                        <a class="fa fa-photo" id="browseFile">
                                            <span>Browse file</span>
                                        </a>
                                        <!-- hidden input -->
                                        <input type="file" id="file" style="display: none;" name="">
                                        <a class="fa fa-camera" id="takePicture"><span>Take a picture</span></a>
                                        <input type="file" accept="image/*" capture="image/*;capture=camera" style="display: none;" id="cameraUpload">
                                    </p>
                                </div>
                                <div class="field">
                                    <label class="label">Name</label>
                                    <p class="control">
                                        <input class="input" type="text" placeholder="Jhone Doe" id="fieldName">
                                    </p>
                                </div>
                                <div class="field">
                                    <label class="label">Email</label>
                                    <p class="control">
                                        <input class="input" type="email" placeholder="Neo@dyned.com" id="fieldEmail">
                                    </p>
                                </div>
                                <div class="field">
                                    <label class="label">Password</label>
                                    <p class="control">
                                        <input class="input" type="password" placeholder="*****" id="fieldPassword">
                                    </p>
                                </div>
                                <div class="phone__text" style="color: #ff5858;display: none;position: absolute;" id="alert-signUp">
                                    All fields are required
                                </div>
                                <div class="phone__text" style="color: #ff5858;display: none;position: absolute;" id="alert-email">
                                    Not a valid email address
                                </div>
                            </div>
                        </div>
                        <div class="signin">
                            Already have an account? <span><a class="toggleSignin">Sign in</a></span>
                        </div>
                        <button class="neobutton next" id="signUp">SIGN UP</button>
                    </section>
                </div>
                <!-- PHONE CONFIRMATION -->
                <div class="sectionbox" id="step-phone">
                    <section class="box__assessment">
                        <div class="assignup">
                            <!-- <div class="signup__title">
                                    Phone Confirmation
                                </div> -->
                            <div class="signup__form">
                                <div class="field">
                                    <label class="label">Phone Number</label>
                                    <p class="control">
                                        <select class="phone--selection" name="countryCode" id="countryCode" style="width:20%;">
                                            <option data-countryCode="DZ" value="+213">Algeria (+213)</option>
                                            <option data-countryCode="AD" value="+376">Andorra (+376)</option>
                                            <option data-countryCode="AO" value="+244">Angola (+244)</option>
                                            <option data-countryCode="AI" value="+1264">Anguilla (+1264)</option>
                                            <option data-countryCode="AG" value="+1268">Antigua &amp; Barbuda (+1268)</option>
                                            <option data-countryCode="AR" value="+54">Argentina (+54)</option>
                                            <option data-countryCode="AM" value="+374">Armenia (+374)</option>
                                            <option data-countryCode="AW" value="+297">Aruba (+297)</option>
                                            <option data-countryCode="AU" value="+61">Australia (+61)</option>
                                            <option data-countryCode="AT" value="+43">Austria (+43)</option>
                                            <option data-countryCode="AZ" value="+994">Azerbaijan (+994)</option>
                                            <option data-countryCode="BS" value="+1242">Bahamas (+1242)</option>
                                            <option data-countryCode="BH" value="+973">Bahrain (+973)</option>
                                            <option data-countryCode="BD" value="+880">Bangladesh (+880)</option>
                                            <option data-countryCode="BB" value="+1246">Barbados (+1246)</option>
                                            <option data-countryCode="BY" value="+375">Belarus (+375)</option>
                                            <option data-countryCode="BE" value="+32">Belgium (+32)</option>
                                            <option data-countryCode="BZ" value="+501">Belize (+501)</option>
                                            <option data-countryCode="BJ" value="+229">Benin (+229)</option>
                                            <option data-countryCode="BM" value="+1441">Bermuda (+1441)</option>
                                            <option data-countryCode="BT" value="+975">Bhutan (+975)</option>
                                            <option data-countryCode="BO" value="+591">Bolivia (+591)</option>
                                            <option data-countryCode="BA" value="+387">Bosnia Herzegovina (+387)</option>
                                            <option data-countryCode="BW" value="+267">Botswana (+267)</option>
                                            <option data-countryCode="BR" value="+55">Brazil (+55)</option>
                                            <option data-countryCode="BN" value="+673">Brunei (+673)</option>
                                            <option data-countryCode="BG" value="+359">Bulgaria (+359)</option>
                                            <option data-countryCode="BF" value="+226">Burkina Faso (+226)</option>
                                            <option data-countryCode="BI" value="+257">Burundi (+257)</option>
                                            <option data-countryCode="KH" value="+855">Cambodia (+855)</option>
                                            <option data-countryCode="CM" value="+237">Cameroon (+237)</option>
                                            <option data-countryCode="CA" value="+1">Canada (+1)</option>
                                            <option data-countryCode="CV" value="+238">Cape Verde Islands (+238)</option>
                                            <option data-countryCode="KY" value="+1345">Cayman Islands (+1345)</option>
                                            <option data-countryCode="CF" value="+236">Central African Republic (+236)</option>
                                            <option data-countryCode="CL" value="+56">Chile (+56)</option>
                                            <option data-countryCode="CN" value="+86">China (+86)</option>
                                            <option data-countryCode="CO" value="+57">Colombia (+57)</option>
                                            <option data-countryCode="KM" value="+269">Comoros (+269)</option>
                                            <option data-countryCode="CG" value="+242">Congo (+242)</option>
                                            <option data-countryCode="CK" value="+682">Cook Islands (+682)</option>
                                            <option data-countryCode="CR" value="+506">Costa Rica (+506)</option>
                                            <option data-countryCode="HR" value="+385">Croatia (+385)</option>
                                            <option data-countryCode="CU" value="+53">Cuba (+53)</option>
                                            <option data-countryCode="CY" value="+90392">Cyprus North (+90392)</option>
                                            <option data-countryCode="CY" value="+357">Cyprus South (+357)</option>
                                            <option data-countryCode="CZ" value="+42">Czech Republic (+42)</option>
                                            <option data-countryCode="DK" value="+45">Denmark (+45)</option>
                                            <option data-countryCode="DJ" value="+253">Djibouti (+253)</option>
                                            <option data-countryCode="DM" value="+1809">Dominica (+1809)</option>
                                            <option data-countryCode="DO" value="+1809">Dominican Republic (+1809)</option>
                                            <option data-countryCode="EC" value="+593">Ecuador (+593)</option>
                                            <option data-countryCode="EG" value="+20">Egypt (+20)</option>
                                            <option data-countryCode="SV" value="+503">El Salvador (+503)</option>
                                            <option data-countryCode="GQ" value="+240">Equatorial Guinea (+240)</option>
                                            <option data-countryCode="ER" value="+291">Eritrea (+291)</option>
                                            <option data-countryCode="EE" value="+372">Estonia (+372)</option>
                                            <option data-countryCode="ET" value="+251">Ethiopia (+251)</option>
                                            <option data-countryCode="FK" value="+500">Falkland Islands (+500)</option>
                                            <option data-countryCode="FO" value="+298">Faroe Islands (+298)</option>
                                            <option data-countryCode="FJ" value="+679">Fiji (+679)</option>
                                            <option data-countryCode="FI" value="+358">Finland (+358)</option>
                                            <option data-countryCode="FR" value="+33">France (+33)</option>
                                            <option data-countryCode="GF" value="+594">French Guiana (+594)</option>
                                            <option data-countryCode="PF" value="+689">French Polynesia (+689)</option>
                                            <option data-countryCode="GA" value="+241">Gabon (+241)</option>
                                            <option data-countryCode="GM" value="+220">Gambia (+220)</option>
                                            <option data-countryCode="GE" value="+7880">Georgia (+7880)</option>
                                            <option data-countryCode="DE" value="+49">Germany (+49)</option>
                                            <option data-countryCode="GH" value="+233">Ghana (+233)</option>
                                            <option data-countryCode="GI" value="+350">Gibraltar (+350)</option>
                                            <option data-countryCode="GR" value="+30">Greece (+30)</option>
                                            <option data-countryCode="GL" value="+299">Greenland (+299)</option>
                                            <option data-countryCode="GD" value="+1473">Grenada (+1473)</option>
                                            <option data-countryCode="GP" value="+590">Guadeloupe (+590)</option>
                                            <option data-countryCode="GU" value="+671">Guam (+671)</option>
                                            <option data-countryCode="GT" value="+502">Guatemala (+502)</option>
                                            <option data-countryCode="GN" value="+224">Guinea (+224)</option>
                                            <option data-countryCode="GW" value="+245">Guinea - Bissau (+245)</option>
                                            <option data-countryCode="GY" value="+592">Guyana (+592)</option>
                                            <option data-countryCode="HT" value="+509">Haiti (+509)</option>
                                            <option data-countryCode="HN" value="+504">Honduras (+504)</option>
                                            <option data-countryCode="HK" value="+852">Hong Kong (+852)</option>
                                            <option data-countryCode="HU" value="+36">Hungary (+36)</option>
                                            <option data-countryCode="IS" value="+354">Iceland (+354)</option>
                                            <option data-countryCode="IN" value="+91">India (+91)</option>
                                            <option data-countryCode="ID" value="+62">Indonesia (+62)</option>
                                            <option data-countryCode="IR" value="+98">Iran (+98)</option>
                                            <option data-countryCode="IQ" value="+964">Iraq (+964)</option>
                                            <option data-countryCode="IE" value="+353">Ireland (+353)</option>
                                            <option data-countryCode="IL" value="+972">Israel (+972)</option>
                                            <option data-countryCode="IT" value="+39">Italy (+39)</option>
                                            <option data-countryCode="JM" value="+1876">Jamaica (+1876)</option>
                                            <option data-countryCode="JP" value="+81">Japan (+81)</option>
                                            <option data-countryCode="JO" value="+962">Jordan (+962)</option>
                                            <option data-countryCode="KZ" value="+7">Kazakhstan (+7)</option>
                                            <option data-countryCode="KE" value="+254">Kenya (+254)</option>
                                            <option data-countryCode="KI" value="+686">Kiribati (+686)</option>
                                            <option data-countryCode="KP" value="+850">Korea North (+850)</option>
                                            <option data-countryCode="KR" value="+82">Korea South (+82)</option>
                                            <option data-countryCode="KW" value="+965">Kuwait (+965)</option>
                                            <option data-countryCode="KG" value="+996">Kyrgyzstan (+996)</option>
                                            <option data-countryCode="LA" value="+856">Laos (+856)</option>
                                            <option data-countryCode="LV" value="+371">Latvia (+371)</option>
                                            <option data-countryCode="LB" value="+961">Lebanon (+961)</option>
                                            <option data-countryCode="LS" value="+266">Lesotho (+266)</option>
                                            <option data-countryCode="LR" value="+231">Liberia (+231)</option>
                                            <option data-countryCode="LY" value="+218">Libya (+218)</option>
                                            <option data-countryCode="LI" value="+417">Liechtenstein (+417)</option>
                                            <option data-countryCode="LT" value="+370">Lithuania (+370)</option>
                                            <option data-countryCode="LU" value="+352">Luxembourg (+352)</option>
                                            <option data-countryCode="MO" value="+853">Macao (+853)</option>
                                            <option data-countryCode="MK" value="+389">Macedonia (+389)</option>
                                            <option data-countryCode="MG" value="+261">Madagascar (+261)</option>
                                            <option data-countryCode="MW" value="+265">Malawi (+265)</option>
                                            <option data-countryCode="MY" value="+60">Malaysia (+60)</option>
                                            <option data-countryCode="MV" value="+960">Maldives (+960)</option>
                                            <option data-countryCode="ML" value="+223">Mali (+223)</option>
                                            <option data-countryCode="MT" value="+356">Malta (+356)</option>
                                            <option data-countryCode="MH" value="+692">Marshall Islands (+692)</option>
                                            <option data-countryCode="MQ" value="+596">Martinique (+596)</option>
                                            <option data-countryCode="MR" value="+222">Mauritania (+222)</option>
                                            <option data-countryCode="YT" value="+269">Mayotte (+269)</option>
                                            <option data-countryCode="MX" value="+52">Mexico (+52)</option>
                                            <option data-countryCode="FM" value="+691">Micronesia (+691)</option>
                                            <option data-countryCode="MD" value="+373">Moldova (+373)</option>
                                            <option data-countryCode="MC" value="+377">Monaco (+377)</option>
                                            <option data-countryCode="MN" value="+976">Mongolia (+976)</option>
                                            <option data-countryCode="MS" value="+1664">Montserrat (+1664)</option>
                                            <option data-countryCode="MA" value="+212">Morocco (+212)</option>
                                            <option data-countryCode="MZ" value="+258">Mozambique (+258)</option>
                                            <option data-countryCode="MN" value="+95">Myanmar (+95)</option>
                                            <option data-countryCode="NA" value="+264">Namibia (+264)</option>
                                            <option data-countryCode="NR" value="+674">Nauru (+674)</option>
                                            <option data-countryCode="NP" value="+977">Nepal (+977)</option>
                                            <option data-countryCode="NL" value="+31">Netherlands (+31)</option>
                                            <option data-countryCode="NC" value="+687">New Caledonia (+687)</option>
                                            <option data-countryCode="NZ" value="+64">New Zealand (+64)</option>
                                            <option data-countryCode="NI" value="+505">Nicaragua (+505)</option>
                                            <option data-countryCode="NE" value="+227">Niger (+227)</option>
                                            <option data-countryCode="NG" value="+234">Nigeria (+234)</option>
                                            <option data-countryCode="NU" value="+683">Niue (+683)</option>
                                            <option data-countryCode="NF" value="+672">Norfolk Islands (+672)</option>
                                            <option data-countryCode="NP" value="+670">Northern Marianas (+670)</option>
                                            <option data-countryCode="NO" value="+47">Norway (+47)</option>
                                            <option data-countryCode="OM" value="+968">Oman (+968)</option>
                                            <option data-countryCode="PW" value="+680">Palau (+680)</option>
                                            <option data-countryCode="PA" value="+507">Panama (+507)</option>
                                            <option data-countryCode="PG" value="+675">Papua New Guinea (+675)</option>
                                            <option data-countryCode="PY" value="+595">Paraguay (+595)</option>
                                            <option data-countryCode="PE" value="+51">Peru (+51)</option>
                                            <option data-countryCode="PH" value="+63">Philippines (+63)</option>
                                            <option data-countryCode="PL" value="+48">Poland (+48)</option>
                                            <option data-countryCode="PT" value="+351">Portugal (+351)</option>
                                            <option data-countryCode="PR" value="+1787">Puerto Rico (+1787)</option>
                                            <option data-countryCode="QA" value="+974">Qatar (+974)</option>
                                            <option data-countryCode="RE" value="+262">Reunion (+262)</option>
                                            <option data-countryCode="RO" value="+40">Romania (+40)</option>
                                            <option data-countryCode="RU" value="+7">Russia (+7)</option>
                                            <option data-countryCode="RW" value="+250">Rwanda (+250)</option>
                                            <option data-countryCode="SM" value="+378">San Marino (+378)</option>
                                            <option data-countryCode="ST" value="+239">Sao Tome &amp; Principe (+239)</option>
                                            <option data-countryCode="SA" value="+966">Saudi Arabia (+966)</option>
                                            <option data-countryCode="SN" value="+221">Senegal (+221)</option>
                                            <option data-countryCode="CS" value="+381">Serbia (+381)</option>
                                            <option data-countryCode="SC" value="+248">Seychelles (+248)</option>
                                            <option data-countryCode="SL" value="+232">Sierra Leone (+232)</option>
                                            <option data-countryCode="SG" value="+65">Singapore (+65)</option>
                                            <option data-countryCode="SK" value="+421">Slovak Republic (+421)</option>
                                            <option data-countryCode="SI" value="+386">Slovenia (+386)</option>
                                            <option data-countryCode="SB" value="+677">Solomon Islands (+677)</option>
                                            <option data-countryCode="SO" value="+252">Somalia (+252)</option>
                                            <option data-countryCode="ZA" value="+27">South Africa (+27)</option>
                                            <option data-countryCode="ES" value="+34">Spain (+34)</option>
                                            <option data-countryCode="LK" value="+94">Sri Lanka (+94)</option>
                                            <option data-countryCode="SH" value="+290">St. Helena (+290)</option>
                                            <option data-countryCode="KN" value="+1869">St. Kitts (+1869)</option>
                                            <option data-countryCode="SC" value="+1758">St. Lucia (+1758)</option>
                                            <option data-countryCode="SD" value="+249">Sudan (+249)</option>
                                            <option data-countryCode="SR" value="+597">Suriname (+597)</option>
                                            <option data-countryCode="SZ" value="+268">Swaziland (+268)</option>
                                            <option data-countryCode="SE" value="+46">Sweden (+46)</option>
                                            <option data-countryCode="CH" value="+41">Switzerland (+41)</option>
                                            <option data-countryCode="SI" value="+963">Syria (+963)</option>
                                            <option data-countryCode="TW" value="+886">Taiwan (+886)</option>
                                            <option data-countryCode="TJ" value="+7">Tajikstan (+7)</option>
                                            <option data-countryCode="TH" value="+66">Thailand (+66)</option>
                                            <option data-countryCode="TG" value="+228">Togo (+228)</option>
                                            <option data-countryCode="TO" value="+676">Tonga (+676)</option>
                                            <option data-countryCode="TT" value="+1868">Trinidad &amp; Tobago (+1868)</option>
                                            <option data-countryCode="TN" value="+216">Tunisia (+216)</option>
                                            <option data-countryCode="TR" value="+90">Turkey (+90)</option>
                                            <option data-countryCode="TM" value="+7">Turkmenistan (+7)</option>
                                            <option data-countryCode="TM" value="+993">Turkmenistan (+993)</option>
                                            <option data-countryCode="TC" value="+1649">Turks &amp; Caicos Islands (+1649)</option>
                                            <option data-countryCode="TV" value="+688">Tuvalu (+688)</option>
                                            <option data-countryCode="UG" value="+256">Uganda (+256)</option>
                                            <option data-countryCode="GB" value="+44">UK (+44)</option>
                                            <option data-countryCode="UA" value="+380">Ukraine (+380)</option>
                                            <option data-countryCode="AE" value="+971">United Arab Emirates (+971)</option>
                                            <option data-countryCode="UY" value="+598">Uruguay (+598)</option>
                                            <option data-countryCode="US" value="+1">USA (+1)</option>
                                            <option data-countryCode="UZ" value="+7">Uzbekistan (+7)</option>
                                            <option data-countryCode="VU" value="+678">Vanuatu (+678)</option>
                                            <option data-countryCode="VA" value="+379">Vatican City (+379)</option>
                                            <option data-countryCode="VE" value="+58">Venezuela (+58)</option>
                                            <option data-countryCode="VN" value="+84">Vietnam (+84)</option>
                                            <option data-countryCode="VG" value="+84">Virgin Islands - British (+1284)</option>
                                            <option data-countryCode="VI" value="+84">Virgin Islands - US (+1340)</option>
                                            <option data-countryCode="WF" value="+681">Wallis &amp; Futuna (+681)</option>
                                            <option data-countryCode="YE" value="+969">Yemen (North)(+969)</option>
                                            <option data-countryCode="YE" value="+967">Yemen (South)(+967)</option>
                                            <option data-countryCode="ZM" value="+260">Zambia (+260)</option>
                                            <option data-countryCode="ZW" value="+263">Zimbabwe (+263)</option>
                                        </select>
                                        <input class="input" type="number" id="phonenum1" onkeypress="return numOnly(event)" />
                                    </p>
                                </div>
                                <div class="phone__text">
                                    Your number is private and will not be shared
                                </div>
                                <div class="phone__text" style="color: #ff5858;display: none;position: absolute;" id="alert-phone">
                                    Phone number is required
                                </div>
                            </div>
                        </div>
                        <button class="neobutton next" id="startTimer">NEXT</button>
                    </section>
                </div>
                <!-- PHONE CONFIRMATION CODE -->
                <div class="sectionbox">
                    <section class="box__assessment">
                        <div class="assignup">
                            <!-- <div class="signup__title">
                                    Phone Confirmation
                                </div> -->
                            <div class="signup__form">
                                <div class="field">
                                    <label class="label">Phone Number</label>
                                    <p class="control">
                                        <select class="phone--selection" name="countryCode" id="" disabled>
                                            <option value="" id="phonecode"></option> <i class="fa fa-arrow-down"></i>
                                        </select>
                                        <input class="input" type="text" id="phonenum2" disabled>
                                        <input type="hidden" id="phonenum3">
                                    </p>
                                </div>
                                <div class="phone__text">
                                    Your number is private and will not be shared
                                </div>
                                <div class="field" style="margin-top: 15px;">
                                    <p class="control">
                                        <h3>Enter the six digit verification code we've sent you by SMS.</h3>
                                        <a class="blue"> Resend code</a>
                                    </p>
                                </div>
                                <div class="field" style="margin-top: 15px;">
                                    <p class="control">
                                        <input class="input" type="text" placeholder="" id="verifcode" style="min-width: 80%;">
                                        <span class="countdown" style="margin-left: 15px;max-width: 20%;width: 20%;"></span>
                                    </p>
                                    <div class="phone__text warning" id="alert-verif">
                                        Please fill the verification code
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="neobutton next" id="next-phone">NEXT</button>
                    </section>
                </div>
                <!--  ============== SET YOUR GOAL ============== -->
                <div class="sectionbox" id="step-goal">
                    <section class="box__accordion" id="goalAccordion">
                        <!-- <h1 class="titlearco textcl--secondary">Set Your Goal</h1> -->
                        <ul class="accordion accordion__margin">
                            <li data-text-default="Career In English">
                                <input type="checkbox" class="toggleMenu" checked>
                                <i></i>
                                <h2>Career In English</h2>
                                <div class="accordion__menu" hideMe="1" cert="A1">Intern</div>
                                <div class="accordion__menu" hideMe="2" cert="A2">Junior Manager</div>
                                <div class="accordion__menu" hideMe="3" cert="B1">Middle Manager</div>
                                <div class="accordion__menu" hideMe="4" cert="B2">Senior Manager</div>
                                <div class="accordion__menu" hideMe="5" cert="C1">Executive</div>
                                <!-- <div class="accordion__menu" hideMe="6" cert="C2">CEO</div> -->
                            </li>
                            <li data-text-default="Education In English">
                                <input type="checkbox" class="toggleMenu" checked>
                                <i></i>
                                <h2>Education In English</h2>
                                <div class="accordion__menu" hideMe="1" cert="A1">Travel</div>
                                <div class="accordion__menu" hideMe="2" cert="A2">Middle School</div>
                                <div class="accordion__menu" hideMe="3" cert="B1">Jr High School</div>
                                <div class="accordion__menu" hideMe="4" cert="B2">Top Senior High School Community College</div>
                                <div class="accordion__menu" hideMe="5" cert="C1">Top Community College University</div>
                                <!-- <div class="accordion__menu" hideMe="6" cert="C2">Top University</div> -->
                            </li>
                            <li data-text-default="Life In English">
                                <input type="checkbox" class="toggleMenu" checked>
                                <i></i>
                                <h2>Life In English</h2>
                                <div class="accordion__menu" hideMe="1" cert="A1">Read to a Child</div>
                                <div class="accordion__menu" hideMe="2" cert="A2">Follow Movies</div>
                                <div class="accordion__menu" hideMe="3" cert="B1">World News</div>
                                <div class="accordion__menu" hideMe="4" cert="B2">Full Social Media</div>
                                <div class="accordion__menu" hideMe="5" cert="C1">Active Dinner Conversations</div>
                                <!-- <div class="accordion__menu" hideMe="6" cert="C2">Your Life In English</div> -->
                            </li>
                            <li data-text-default="Abroad In English">
                                <input type="checkbox" class="toggleMenu" checked>
                                <i></i>
                                <h2>Abroad In English</h2>
                                <div class="accordion__menu" hideMe="1" cert="A1">Use Tourist Offices</div>
                                <div class="accordion__menu" hideMe="2" cert="A2">International Hotel Stays</div>
                                <div class="accordion__menu" hideMe="3" cert="B1">Interact With Locals</div>
                                <div class="accordion__menu" hideMe="4" cert="B2">Active Dinner Conversations</div>
                                <div class="accordion__menu" hideMe="5" cert="C1">Lead Family & Friends on Tours</div>
                                <!-- <div class="accordion__menu" hideMe="6" cert="C2">Your Life In English</div> -->
                            </li>
                        </ul>
                        <div class="phone__text warning" id="alert-goal">
                            Please select your goal
                        </div>
                        <input type="hidden" id="selectedGoal" value="">
                        <div class="box__accordion--notif"></div>
                        <button class="neobutton next" id="next-setGoal">NEXT</button>
                    </section>
                </div>
                <div class="sectionbox" style="margin: 20px 0px 20px 0px">
                    <section class="box__accordion" id="goalAchieve">
                        <h1 class="titlearco textcl--secondary">What you can achieve</h1>
                        <div class="nowgoal">
                            <div class="pt_logo" id="imgHere">
                                <!-- <img src="assets/img/B2-large.png"> -->
                            </div>
                            <div class="nowgoal_contents">
                                <div class="nowgoal_content1">
                                    <h2 class="text-center">What you can achieve</h2>
                                    <ul>
                                        <li>Fluency in speaking</li>
                                        <li>Better communication skills</li>
                                        <li>Confidence in meeting</li>
                                        <li>Successful social and business connections</li>
                                        <li>Better understanding in professional situations</li>
                                    </ul>
                                </div>
                                <div class="nowgoal_content2" id="nowGoalContent" style="display: none; margin-top: 20px;">
                                    <div class="image__wrap">
                                        <div class="image__profile--text blue-text-dark" id="certificationName">
                                        </div>
                                        <div class="image__profile">
                                            <img class="image__upload imageUp" id="imageUp" src="assets/img/nm.png">
                                        </div>
                                        <img src="assets/img/certification.png">
                                    </div>
                                </div>
                                <button class="neobutton__white" id="buttonGoal"><i class="fa fa-ellipsis-h"></i> more info</button>
                            </div>
                        </div>
                        <button class="neobutton__white" id="changeGoal"><i class="fa fa-repeat"></i></button>
                        <button class="neobutton next" id="next-goal">Set Your Goal</button>
                    </section>
                </div>
                <!-- //sign up -->
                <!--  ============== SELECT PACKAGE ============== -->
                <div class="sectionbox" id="step-package">
                    <div class="box__assessment" id="packageBox">
                        <div class="blue-text text-center spaces">
                            Select Your Package
                        </div>
                        <div class="progress">
                            <div class="circle" id="select1">
                                <span class="label">Starter</span>
                            </div>
                            <span class="bar" id="bar1"></span>
                            <div class="circle" id="select2">
                                <span class="label">A1</span>
                            </div>
                            <span class="bar" id="bar2"></span>
                            <div class="circle" id="select3">
                                <span class="label">A2</span>
                            </div>
                            <span class="bar" id="bar3"></span>
                            <div class="circle" id="select4">
                                <span class="label">B1</span>
                            </div>
                            <span class="bar" id="bar4"></span>
                            <div class="circle" id="select5">
                                <span class="label">B2</span>
                            </div>
                            <span class="bar" id="bar5"></span>
                            <div class="circle" id="select6">
                                <span class="label">C1</span>
                            </div>
                        </div>
                        <!-- <div class="progresss spaces">
                                <ul id="result">
                                    <li id="select1" class="">
                                        <p>Starter</p>
                                    </li>
                                    <li id="select2" class="">
                                        <p>A1</p>
                                    </li>
                                    <li id="select3" class="">
                                        <p>A2</p>
                                    </li>
                                    <li id="select4" class="">
                                        <p>B1</p>
                                    </li>
                                    <li id="select5" class="">
                                        <p>B2</p>
                                    </li>
                                    <li id="select6" class="">
                                        <p>C1</p>
                                    </li>
                                    <li id="select7" class="">
                                        <p>C2</p>
                                    </li>
                                </ul>
                            </div> -->
                        <div class="blue-text text-center spaces">
                            you select
                            <font id="startCert"></font> to
                            <font id="endCert"></font> certifications
                        </div>
                        <div class="linecont spaces">
                            <div class="linehr"></div>
                        </div>
                        <div class="body-text-bold-medium">
                            Payment Options
                        </div>
                        <div class="body-text">
                            Please select your payment options
                        </div>
                        <div class="tab__justify spaces tabLinks" id="tabPayment">
                            <!-- <a class="choose__package" href="#option1">A1
                                <i class="fa fa-check" style="display: none"></i>
                            </a> -->
                        </div>
                        <div class="linecont spaces">
                            <div class="linehr"></div>
                        </div>
                        <div>
                            <!-- option 1 -->
                            <div class="tab__justify spaces" id="option" style="display: none !important;">
                                <div class="col__two">
                                    <ul class="tabs" id="optionPayment">
                                        <!-- <li class="body-text-bold-medium">A1 Graduation Date <span class="graduation"></span>
                                                <span class="duration"></span>
                                            </li> -->
                                    </ul>
                                </div>
                                <div class="col__two--horizontal ">
                                    <input type="hidden" id="selectedPayment" value="">
                                    <button class="neobutton__white nextFull">PAY NOW IN FULL</button>
                                    <button class="neobutton__white nextFull">PAY MONTHLY</button>
                                    <button class="neobutton__white packChange"><i class="fa fa-repeat"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div class="sectionbox">
                        <div class="box__assessment">
                            <div class="blue-text text-center spaces">
                                Select Your Package
                            </div>
                            <div class="box__package spaces">
                                <div class="box__package--info spaces">
                                    <div class="body-text-bold-medium info__package">
                                        Your Packages
                                        <span class="info body-text" id="includePackage">
                                            </span>
                                    </div>
                                    <div class="body-yellow-bold info__package" id="yourPackage">
                                    </div>
                                </div>
                                <div class="linecont">
                                    <div class="linehrDark"></div>
                                </div>
                                <div class="box__package--info spaces">
                                    <div class="body-text-bold-medium info__package">
                                        Pay in full
                                        <span class="info body-text">
                                            <span class="discount  cross"> $70</span> /month
                                        </span>
                                    </div>
                                    <div class="info__package__three">
                                        <div class="body-yellow-bold info__package" style="text-align: right;">
                                            $900</div>
                                        <span class="info">
                                                $60 /month
                                            </span>
                                        <span class="info--detail">
                                                for 15 month total and a coaching sessions per month
                                            </span>
                                    </div>
                                </div>
                                <div class="linecont">
                                    <div class="linehrDark"></div>
                                </div>
                            </div>
                            <button class="neobutton__white">Pay now</button>
                            <button class="neobutton__white" id="cancelPay">Cancel</button>
                        </div>
                    </div>
                    <!--  -->
                    <!--  ============== P A Y M E N T ============== -->
                    <div class="sectionbox">
                        <section class="box_payment">
                            <div class="payment__title">
                                Payment
                            </div>
                            <div class="payment__ul">
                                <ul class="tabs">
                                    <li class="tab-link current" data-tab="tab-1">Credit Card</li>
                                    <li class="tab-link" data-tab="tab-2">Paypal</li>
                                </ul>
                            </div>
                            <div class="payment">
                                <div class="payment__credit tab-content current" id="tab-1">
                                    <div class="accountinfo">
                                        <span>Account Info</span>
                                        <div class="field">
                                            <label class="label">Name</label>
                                            <p class="control">
                                                <input class="input" type="text" placeholder="John Doe">
                                            </p>
                                        </div>
                                        <div class="field">
                                            <label class="label">Email</label>
                                            <p class="control">
                                                <input class="input" type="email" placeholder="Neo@dyned.com">
                                            </p>
                                        </div>
                                        <div class="field">
                                            <label class="label">Password</label>
                                            <p class="control">
                                                <input class="input" type="password" placeholder="*********">
                                            </p>
                                        </div>
                                        <div class="field">
                                            <label class="label">Repeat Password</label>
                                            <p class="control">
                                                <input class="input" type="password" placeholder="Repeat Password">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="paymentsDetails">
                                        <span>Payments Details</span>
                                        <div class="field">
                                            <label class="label"> </label>
                                            <p class="control">
                                                <input class="input input1" type="text" placeholder="Card Holder Name">
                                            </p>
                                        </div>
                                        <div class="field">
                                            <label class="label">Card Number</label>
                                            <p class="cardnum">
                                                <input class="input" type="text" placeholder="">
                                                <span> - </span>
                                                <input class="input" type="text" placeholder="">
                                                <span> - </span>
                                                <input class="input" type="text" placeholder="">
                                                <span> - </span>
                                                <input class="input" type="text" placeholder="">
                                            </p>
                                        </div>
                                        <div class="field">
                                            <div class="labelnum">
                                                <label class="label">Expery Date</label>
                                                <label class="label">CVV</label>
                                            </div>
                                            <p class="cardnum">
                                                <input class="input" type="text" placeholder="">
                                                <span> - </span>
                                                <input class="input" type="text" placeholder="">
                                                <span class="span2">  </span>
                                                <input class="input" type="text" placeholder="">
                                            </p>
                                        </div>
                                        <div class="btn__payment">
                                            <button class="neobutton">Lets Get Started</button>
                                            <button class="neobutton" href="#">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="payment__paypal tab-content" id="tab-2">
                                    sdasdasdasd
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        </section>
        </div>