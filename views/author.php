<?php
require './models/Survei.php';
    $s = new Survei();
    $questions = $s->getQuestions($db);
?>
<section id="home-view">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mt-5 mb-5">
                <div class="card mt-3">
                    <img src="public/images/author.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <footer class="blockquote-footer text-center text-info">Antonije Pavlovic <cite> 47/16</cite></footer>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="row">
                    <p class="text-justify mt-5 text-info">
                        Born in Smederevo 1994. He is specialized for road traffic logistics in high school.
                        During those teenage days he finds himself interested in sports, especially in boxing and kickboxing.
                        On the other hand one of his discoverings was passion for acting.
                        Therefore he became core member of school theater at that time.
                        He also took place in numerous humanitarian actions.
                        Now he is on the final year of his bachelor studies on internet technologies.
                        Antonije is friendly and communicative person who loves challenges and competitions.
                    </p>
                </div>
                <?php if(isSession()):?>
                <div class="row justify-content-center">
                    <?php
                        if(!$s->checkUser($db,$_SESSION['user']->userID)):
                    ?>
                    <form class="form">
                        <?php
                            for($j = 0 ; $j < count($questions) ; $j++):
                        ?>
                        <div class="form-group<?= $questions[$j]->id ?>">
                            <label for="questions" id="q<?= $questions[$j]->id ?>" data-id="<?= $questions[$j]->id ?>"><?= $questions[$j]->text ?></label>
                            <?php
                            $id = $questions[$j]->id;
                            $answers = $s->getAnswers($db,$id);
                                for($i = 0 ; $i < count($answers) ; $i++):
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios<?= $j+1?>" data-id="<?= $answers[$i]->id?>" >
                                <label class="form-check-label" for="exampleRadios1">
                                    <?= $answers[$i]->text ?>
                                </label>
                            </div>
                            <?php
                                endfor;
                            ?>
                       </div>
                        <?php endfor;?>
                        <input type="hidden" data-id="<?= $_SESSION['user']->userID ?>" class="userID">
                        <button type="button" class="btn btn-primary survey">Submit</button>
                    </form>
                    <?php
                       else:
                    ?>
                       You are already vote !!!
                    <?php
                        endif;
                    ?>
                </div>
                <?php endif;?>
            </div>
        </div>
        <div class="row mt-5">
            <blockquote class="blockquote pl-5 ml-5">
                <p class="mb-0">Qualis vita, finis ita</p>
                <footer class="blockquote-footer">Latin phrases</footer>
            </blockquote>
        </div>
    </div>
</section>