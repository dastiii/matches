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
<form class="form-horizontal" method="post" role="form" action="<?= $this->getUrl(array('action' => 'save')); ?>">
    <?php echo $this->getTokenField(); ?>
    <legend><?= $this->getTrans('create_match') ?></legend>
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label for="team" class="col-sm-2 control-label"><?= $this->getTrans('team') ?></label>
                <div class="col-sm-8">
                    <select data-placeholder="<?= $this->getTrans('choose_team') ?>" id="team" name="match[team]" class="chosen-select form-control">
                        <option value></option>
                    <?php foreach ($this->get('teams') as $team): ?>
                        <option value="<?= $team->getId() ?>"><?= $team->getName() ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="opponent" class="col-sm-2 control-label"><?= $this->getTrans('opponent') ?></label>
                <div class="col-sm-8">
                    <div class="radio">
                        <label>
                            <input type="radio" class="changeOpponentMethod" name="match[opponent][method]" value="1" checked>
                            <?= $this->getTrans('choose_opponent') ?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" class="changeOpponentMethod" name="match[opponent][method]" value="0">
                            <?= $this->getTrans('create_opponent') ?>
                        </label>
                    </div>
                </div>
            </div>
            <div id="chose_opponent" class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                    <select data-placeholder="<?= $this->getTrans('choose_opponent') ?>" id="opponent" name="match[opponent][id]" class="chosen-select form-control">
                        <option></option>
                    <?php foreach ($this->get('opponents') as $opponent): ?>
                        <option value="<?= $opponent->getId() ?>"><?= $opponent->getName() ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div id="new_opponent" class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" name="match[opponent][name]" class="form-control" placeholder="<?= $this->getTrans('opponent_name') ?>">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="match[opponent][short_name]" class="form-control" placeholder="<?= $this->getTrans('opponent_short_name') ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="matchday" class="col-sm-2 control-label"><?= $this->getTrans('players') ?></label>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="match[guest_lineup]">
                    <span class="help-block"><?=$this->getTrans('seperate_with_commas')?></span>
                </div>
                <div class="col-sm-2">
                    <div class="checkbox">
                        <label>
                            <input name="match[settings][hide_guest_lineup]" type="checkbox" value="1">
                            <?= $this->getTrans('hide') ?>
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="game" class="col-sm-2 control-label"><?= $this->getTrans('game') ?></label>
                <div class="col-sm-8">
                    <input id="game" name="match[game]" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="competition" class="col-sm-2 control-label"><?= $this->getTrans('competition') ?></label>
                <div class="col-sm-8">
                    <input id="competition" name="match[competition]" type="text" class="form-control">
                </div>
                <div class="col-sm-2">
                    <div class="checkbox">
                        <label>
                            <input name="match[settings][hide_competition]" type="checkbox" value="1">
                            <?= $this->getTrans('hide') ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="matchday" class="col-sm-2 control-label"><?= $this->getTrans('matchday') ?></label>
                <div class="col-sm-8">
                    <input id="matchday" name="match[matchday]" type="text" class="form-control">
                </div>
                <div class="col-sm-2">
                    <div class="checkbox">
                        <label>
                            <input name="match[settings][hide_matchday]" type="checkbox" value="1">
                            <?= $this->getTrans('hide') ?>
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="date" class="col-sm-2 control-label"><?= $this->getTrans('date') ?></label>
                <div class="col-sm-8">
                    <input id="datepicker" name="match[datetime]" type="text" class="form-control">
                    <span class="help-block"><?=$this->getTrans('example', date("Y-m-d H:i:s"))?></span>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="date" class="col-sm-2 control-label"><?= $this->getTrans('result') ?></label>
                <div class="col-sm-3">
                    <input type="text" name="match[points_home]" class="form-control text-center" placeholder="<?=$this->getTrans("points_home")?>">
                </div>
                <div class="col-sm-2 text-center"><p class="form-control-static">:</p></div>
                <div class="col-sm-3">
                    <input type="text" name="match[points_guest]" class="form-control text-center" placeholder="<?=$this->getTrans("points_guest")?>">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="match_report" class="col-sm-2 control-label"><?= $this->getTrans('report') ?></label>
                <div class="col-sm-8">
                    <textarea id="ilch_html" name="match[report]" class="form-control" rows="15"></textarea>
                </div>
                <div class="col-sm-2">
                    <div class="checkbox">
                        <label>
                            <input name="match[settings][hide_report]" type="checkbox" value="1">
                            <?= $this->getTrans('hide') ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="panel panel-info">
                <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-question"></i> Weitere Daten</h3></div>
                <div class="panel-body">
                    <p>Weitere Daten wie Spieler, Zwischenstände (Spielrunden), zusätzliche Informationen und Medien können nachträglich hinzugefügt werden.</p>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-question"></i> Freischaltung</h3></div>
                <div class="panel-body">
                    <p>Das Match wird nach dem Klick auf Speichern erstellt, aber noch nicht freigegeben.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="content_savebox">
        <button value="save" type="submit" name="match[save]" class="btn btn-success">Speichern</button>
        <?php // TODO: Nur zeigen, wenn User das Recht hat, Matches freizuschalten ?>
        <button value="save_and_approve" name="match[save]" class="btn">Speichern und freigeben</button>
    </div>
</form>
<script src="<?php echo $this->getUrl(); ?>/application/modules/matches/static/js/jquery-ui-timepicker-addon.js"></script>
<script>
    $(function() {
        $("#datepicker").datetimepicker({
            dateFormat: "yy-mm-dd",
            timeFormat: "HH:mm:ss"
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

        var availableGames = [
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
        $( "#game" ).autocomplete({
            source: availableGames
        });

        switchMethod($("#new_opponent"), $("#chose_opponent"), $(".changeOpponentMethod"));
    });
</script>
