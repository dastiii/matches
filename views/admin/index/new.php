<?php
/**
 * View file for matches/index/new
 *
 * @copyright Ilch 2.0
 * @package ilch
 * @author Tobias Schwarz <tobias.schwarz@gmx.eu>
 */

defined('ACCESS') or die('no direct access');
?>
<form class="form-horizontal" role="form">
    <legend><?= $this->getTrans('create_match') ?></legend>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="team" class="col-sm-2 control-label"><?= $this->getTrans('team') ?></label>
                <div class="col-sm-10">
                    <select id="team" name="match[team]" class="chosen-select form-control">
                    <?php foreach ($this->get('teams') as $team): ?>
                        <option value="<?= $team->getId() ?>"><?= $team->getName() ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="opponent" class="col-sm-2 control-label"><?= $this->getTrans('opponent') ?></label>
                <div class="col-sm-10">
                    <div class="radio">
                        <label>
                            <input type="radio" class="changeOpponentMethod" name="match[opponentMethod]" value="1" checked>
                            <?= $this->getTrans('choose_opponent') ?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" class="changeOpponentMethod" name="match[opponentMethod]" value="0">
                            <?= $this->getTrans('create_opponent') ?>
                        </label>
                    </div>
                </div>
            </div>
            <div id="chose_opponent" class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <select id="opponent" name="match[opponent]" class="chosen-select form-control">
                    <?php foreach ($this->get('opponents') as $opponent): ?>
                        <option value="<?= $opponent->getId() ?>"><?= $opponent->getName() ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div id="new_opponent" class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="Name des Gegners">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="Abk&uuml;rzung des Gegners">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="game" class="col-sm-2 control-label"><?= $this->getTrans('game') ?></label>
                <div class="col-sm-10">
                    <div class="radio">
                        <label>
                            <input type="radio" class="changeGameMethod" name="match[gameMethod]" value="1" checked>
                            <?= $this->getTrans('choose_game') ?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" class="changeGameMethod" name="match[gameMethod]" value="0">
                            <?= $this->getTrans('create_game') ?>
                        </label>
                    </div>
                </div>
            </div>
            <div id="chose_game" class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <select id="opponent" name="match[game]" class="chosen-select form-control">

                    </select>
                </div>
            </div>
            <div id="new_game" class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="text" name="match[game][name]" class="form-control" placeholder="Name des Spiels">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="date" class="col-sm-2 control-label"><?= $this->getTrans('date') ?></label>
                <div class="col-sm-10">
                    <input id="datepicker" name="match[datetime]" type="text" class="form-control">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="competition" class="col-sm-2 control-label"><?= $this->getTrans('competition') ?></label>
                <div class="col-sm-10">
                    <input id="competition" name="match[competition]" type="text" class="form-control">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="matchday" class="col-sm-2 control-label"><?= $this->getTrans('matchday') ?></label>
                <div class="col-sm-10">
                    <input id="matchday" name="match[matchday]" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    Panel content
                </div>
            </div>
        </div>
    </div>

    <?=$this->getSaveBar()?>
</form>
<script src="<?php echo $this->getUrl(); ?>/application/modules/matches/static/js/jquery-ui-timepicker-addon.js"></script>
<script>
    $(function() {
        $("#datepicker").datetimepicker({
            dateFormat: "yy-mm-dd",
            timeFormat: "hh:mm:ss"
        });

        $('.chosen-select').chosen();

        function switchMethod(method1, method2, switcher)
        {
            method1.hide();

            switcher.change(function(){
                if($(this).val() == "0") {
                    method2.slideUp('400', function(){
                        method1.slideDown('400');
                    });
                }
                else
                {
                    method1.slideUp('400', function(){
                        method2.slideDown('400');
                    });
                }
            });
        }

        var availableCompetitions = [
          "ActionScript",
          "AppleScript",
          "Asp",
          "BASIC",
          "C",
          "C++",
          "Clojure",
          "COBOL",
          "ColdFusion",
          "Erlang",
          "Fortran",
          "Groovy",
          "Haskell",
          "Java",
          "JavaScript",
          "Lisp",
          "Perl",
          "PHP",
          "Python",
          "Ruby",
          "Scala",
          "Scheme"
        ];
        $( "#competition" ).autocomplete({
          source: availableCompetitions
        });

        var availableMatchdays = [
          "ActionScript",
          "AppleScript",
          "Asp",
          "BASIC",
          "C",
          "C++",
          "Clojure",
          "COBOL",
          "ColdFusion",
          "Erlang",
          "Fortran",
          "Groovy",
          "Haskell",
          "Java",
          "JavaScript",
          "Lisp",
          "Perl",
          "PHP",
          "Python",
          "Ruby",
          "Scala",
          "Scheme"
        ];
        $( "#matchday" ).autocomplete({
          source: availableMatchdays
        });

        switchMethod($("#new_opponent"), $("#chose_opponent"), $(".changeOpponentMethod"));
        switchMethod($("#new_game"), $("#chose_game"), $('.changeGameMethod'));
    });
</script>
