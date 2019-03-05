<section id="home-view">
    <div class="container text-center mt-5 mb-5">
        <div class="row justify-content-lg-center">
            <h3>
                Apotheke
                <small class="text-muted">customer support</small>
            </h3>
        </div>
        <div class="row mt-5">
            <div class="col-lg-4">
                <form class="mt-5">
                    <div class="form-group mt-3">
                        <label for="exampleFormControlInput1">Email subject</label>
                        <input type="text" class="form-control" id="emailSubject" placeholder="Enter subject here">
                    </div>
                    <div class="form-group mt-5">
                        <label for="exampleFormControlTextarea1">Email text</label>
                        <textarea class="form-control" id="emailTxt" rows="5"></textarea>
                    </div>
                    <?php if(isSession()): ?>
                        <button type="button" class="btn btn-primary mb-2 mt-3 sendMail">Send us email</button>
                    <?php endif;?>
                    <?php if(!isSession()):?>
                        <p class="lead">
                            You need to be registered in order to send us mail
                        </p>
                    <?php endif;?>
                    <input type="hidden" id="email" value="<?= $_SESSION['user']->email?>"/>
                    <input type="hidden" id="username" value="<?= $_SESSION['user']->username?>"/>
                </form>
            </div>
            <div class="col-lg-8 mt-5">
                <div class="row justify-content-lg-center">
                    <p class="h4 text-danger">Contact information</p>
                </div>
                <div class="row mt-5 justify-content-lg-center">
                    <strong> Phone number :</strong><label class="ml-5 text-primary">+3818945786</label>
                </div>
                <div class="row mt-5 justify-content-lg-center">
                    <p class="h4 text-danger">Address: </p>
                </div>
                <div class="row justify-content-lg-center">
                    <label class="text-primary">Duke Stephen street 75</label>
                </div>
                <div class="row justify-content-lg-center">
                    <label class="text-primary">11000 Belgrade</label>
                </div>
                <div class="row justify-content-lg-center">
                    <label class="text-primary">Serbia</label>
                </div>
                <div class="row mt-5 justify-content-lg-center">
                    <p class="h4 text-danger">Working hours: </p>
                </div>
                <div class="row justify-content-lg-center">
                    <strong>Monday to Friday: </strong><label class="ml-5 text-primary">09:00 to 17:00</label>
                </div>
                <div class="row ml-5 justify-content-lg-center">
                    <strong>Saturday: </strong><label class="ml-5 text-primary">09:00 to 15:00</label>
                </div>
                <div class="row ml-2 justify-content-lg-center">
                    <strong>Sunday: </strong><label class="ml-5 text-danger">closed</label>
                </div>
            </div>
        </div>
        <div class="row justify-content-lg-center mt-5">
            <div class="row">
                <p class="h4 text-danger">Our quality claim</p>
            </div>
            <div class="row">
                <p class="h6">The Apotheke Pharmacy is the leading online pharmacy for price and quality conscious consumers in Austria and Germany. We achieve this goal with you, esteemed customer who appreciates the best service, optimal product quality, a wide choice and competitive prices!
                    We guarantee that our website will only sell goods from selected and tested Austrian drug retailers and leading international and national manufacturers of pharmacy products.We check all suppliers according to the strictest criteria, which voluntarily exceed the minimum requirements under Austrian and European law. We work closely with Austrian pharmacy experts, so that our range is always up to date and meets the highest quality standards.</p>
            </div>
        </div>
    </div>
</section>