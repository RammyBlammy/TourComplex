<?php

/** @var yii\web\View $this */

$this->title = 'Контакты';
?>
<div class="container">
            <div class="text-muted align-center w-100 m-auto">
                <h2 class="h1-responsive font-weight-bold text-center my-4">Свяжитесь с нами<img src="../images/smile.png" alt=""></h2>
                <!--Section description-->
                <p class="text-center w-responsive mx-auto mb-5">Возникли вопросы? Хотите указать на недочеты или похвалить? Свяжитесь с нами по этой форме, 
                    и мы ответим так скоро, как только сможем! 
                    </p>
                <div class="row">
                    <!--Grid column-->
                    <div class="col-md-9 mb-md-0 mb-5">
                        <form id="contact-form" name="contact-form"  method="POST">
                            <!--Grid row-->
                            <div class="row">

                                <!--Grid column-->
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                    <label for="name" class="">Имя</label>
                                        <input type="text" id="name1" name="name" class="form-control greenf">
                                        
                                    </div>
                                </div>
                                <!--Grid column-->

                                <!--Grid column-->
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                    <label for="email" class="">Email</label>
                                        <input type="text" id="email1" name="email" class="form-control greenf">
                                        
                                    </div>
                                </div>
                                <!--Grid column-->

                            </div>
                            <!--Grid row-->

                            <!--Grid row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form mb-0">
                                    <label for="subject" class="">Тема</label>
                                        <input type="text" id="subject1" name="subject" class="form-control greenf">
                                        
                                    </div>
                                </div>
                            </div>
                            <!--Grid row-->

                            <!--Grid row-->
                            <div class="row">

                                <!--Grid column-->
                                <div class="col-md-12">

                                    <div class="md-form">
                                    <label for="message">Сообщение</label>
                                        <textarea type="text" id="message1" name="message" rows="3" class="form-control md-textarea greenf"></textarea>
                                        
                                    </div>

                                </div>
                            </div>
                            <!--Grid row-->

                        </form>

                        <div class="text-center text-md-left mt-2">
                            <a class="btn btn-success greenf"> Отправить письмо</a>
                        </div>
                        <div class="status"></div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-3 text-center">
                        <ul class="list-unstyled mb-0">
                            <li><img src="../images/ukaz.png" alt="">
                                <p>Макеевка</p>
                            </li>

                            <li><img src="../images/tel.png" alt="">
                                <p>+7(949)336-52-10</p>
                            </li>

                            <li><img src="../images/mail.png" alt="">
                                <p>supernaturalsd69@gmail.com</p>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->

                </div>
            </div>
        </div>