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
    <?php echo $this->getTokenField(); ?>
    <legend><?= $this->getTrans('create_match') ?></legend>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="team" class="col-sm-1 control-label"><?= $this->getTrans('team') ?></label>
                <div class="col-sm-5">
                    <select data-placeholder="<?= $this->getTrans('choose_team') ?>" id="team" name="match[team]" class="chosen-select form-control">
                        <option value></option>
                    <?php foreach ($this->get('teams') as $team): ?>
                        <option value="<?= $team->getId() ?>"><?= $team->getName() ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="matchday" class="col-sm-1 control-label"><?= $this->getTrans('players') ?></label>
                <div class="col-sm-5">
                    <select data-placeholder="<?= $this->getTrans('choose_players') ?>" id="home_lineup" name="match[home_lineup]" class="chosen-select form-control" multiple>
                        <option></option>
                    </select>
                    <p id="home_lineup_placeholder" class="form-control-static"><?= $this->getTrans('choose_team_first') ?></p>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="opponent" class="col-sm-1 control-label"><?= $this->getTrans('opponent') ?></label>
                <div class="col-sm-5">
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
                <div class="col-sm-5 col-sm-offset-1">
                    <select data-placeholder="<?= $this->getTrans('choose_opponent') ?>" id="opponent" name="match[opponent]" class="chosen-select form-control">
                        <option></option>
                    <?php foreach ($this->get('opponents') as $opponent): ?>
                        <option value="<?= $opponent->getId() ?>"><?= $opponent->getName() ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div id="new_opponent" class="form-group">
                <div class="col-sm-5 col-sm-offset-1">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="<?= $this->getTrans('opponent_name') ?>">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="<?= $this->getTrans('opponent_short_name') ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="matchday" class="col-sm-1 control-label"><?= $this->getTrans('players') ?></label>
                <div class="col-sm-5">
                    <input class="form-control" type="text" name="match[guest_players]">
                    <span class="help-block"><?=$this->getTrans('seperate_with_commas')?></span>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox">
                        <label>
                            <input name="match[settings][hide_guest_players]" type="checkbox" value="1">
                            ausblenden
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="game" class="col-sm-1 control-label"><?= $this->getTrans('game') ?></label>
                <div class="col-sm-5">
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
                <div class="col-sm-5 col-sm-offset-1">
                    <select data-placeholder="<?=$this->getTrans('choose_game') ?>" id="opponent" name="match[game]" class="chosen-select form-control">

                    </select>
                </div>
            </div>
            <div id="new_game" class="form-group">
                <div class="col-sm-5 col-sm-offset-1">
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="text" name="match[game][name]" class="form-control" placeholder="<?=$this->getTrans('game_name') ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="competition" class="col-sm-1 control-label"><?= $this->getTrans('competition') ?></label>
                <div class="col-sm-5">
                    <input id="competition" name="match[competition]" type="text" class="form-control">
                </div>
                <div class="col-sm-3">
                    <div class="checkbox">
                        <label>
                            <input name="match[settings][hide_competition]" type="checkbox" value="1">
                            ausblenden
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="matchday" class="col-sm-1 control-label"><?= $this->getTrans('matchday') ?></label>
                <div class="col-sm-5">
                    <input id="matchday" name="match[matchday]" type="text" class="form-control">
                </div>
                <div class="col-sm-3">
                    <div class="checkbox">
                        <label>
                            <input name="match[settings][hide_matchday]" type="checkbox" value="1">
                            ausblenden
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="date" class="col-sm-1 control-label"><?= $this->getTrans('date') ?></label>
                <div class="col-sm-5">
                    <input id="datepicker" name="match[datetime]" type="text" class="form-control">
                    <span class="help-block"><?=$this->getTrans('example', date("Y-m-d H:i:s"))?></span>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="date" class="col-sm-1 control-label"><?= $this->getTrans('additional_information') ?></label>
                <div class="col-sm-5">
                    <span class="help-block">Hier können zusätzliche Informationen, wie z.B. Serveraddressen, hinzugefügt werden.</span>
                    <a id="additional_fields_add" class="btn-link" href="#">&raquo; <?=$this->getTrans('add_new_field')?></a>
                </div>
            </div>
            <div id="additional_fields">
            </div>
            <hr>
            <div class="form-group">
                <label for="date" class="col-sm-1 control-label"><?= $this->getTrans('matchrounds') ?></label>
                <div class="col-sm-5">
                    <span class="help-block"><?=$this->getTrans('rounds_text')?></span>
                    <a id="rounds_add" class="btn-link" href="#">&raquo; <?=$this->getTrans('add_new_round')?></a>
                </div>
            </div>
            <div id="rounds">

            </div>
            <hr>
            <div class="form-group">
                <label for="date" class="col-sm-1 control-label"><?= $this->getTrans('result') ?></label>
                <div class="col-sm-2">
                    <input type="text" name="match[points_home]" class="form-control text-center" placeholder="<?=$this->getTrans("points_home")?>">
                </div>
                <div class="col-sm-1 text-center">:</div>
                <div class="col-sm-2">
                    <input type="text" name="match[points_guest]" class="form-control text-center" placeholder="<?=$this->getTrans("points_guest")?>">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="match_report" class="col-sm-1 control-label"><?= $this->getTrans('report') ?></label>
                <div class="col-sm-5">
                    <textarea id="ilch_html" name="match[report]" class="form-control" rows="15"></textarea>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox">
                        <label>
                            <input name="match[settings][hide_report]" type="checkbox" value="1">
                            ausblenden
                        </label>
                    </div>
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

        switchMethod($("#new_opponent"), $("#chose_opponent"), $(".changeOpponentMethod"));
        switchMethod($("#new_game"), $("#chose_game"), $('.changeGameMethod'));

        var teamSelect = $("#team");
        var homeLineup = $("#home_lineup");
        var homeLineupChosen = $("#home_lineup_chosen");
        var homeLineupP = $("#home_lineup_placeholder");

        // Hide select until a team is selected
        homeLineupChosen.hide();

        teamSelect.change(function(){
            $.ajax({
                url: "<?=$this->getUrl()?>/index.php/admin/matches/index/teammembers",
                dataType: "html",
                type: "POST",
                data: {
                    teamId: teamSelect.val(),
                    ilch_token: $("input[name=ilch_token]").val()
                },
                error: function(xhr, status, error){
                    homeLineupChosen.hide();
                    homeLineupP.show();
                },
                success: function(data, status, xhr){
                    homeLineupP.hide();
                    homeLineup.html(data);
                    homeLineup.trigger("chosen:updated");
                    homeLineupChosen.show();
                },
                complete: function(xhr, status){
                    // .
                }
            });
        });

        var additional_fields_container = $( "#additional_fields" );

        additional_fields_container.delegate('.additional_field_destroy', 'click', function(e){
            e.preventDefault();
            $("#" + $(this).data('destroy')).remove();
        });

        var additional_fields_increment = 1;

        $('#additional_fields_add').click(function(e){
            e.preventDefault();
            additional_fields_container.append('<div id="additional_field_' + additional_fields_increment + '" class="form-group"><div class="col-sm-2 col-sm-offset-1"><input placeholder="<?=$this->getTrans("additional_fields_name")?>" type="text" name="match[additional_fields][' + additional_fields_increment + '][key]" class="form-control"></div><div class="col-sm-3"><input placeholder="<?=$this->getTrans("additional_fields_value")?>" type="text" name="match[additional_fields][' + additional_fields_increment + '][value]" class="form-control"></div><div class="col-sm-1"><a class="btn btn-default additional_field_destroy" data-destroy="additional_field_' + additional_fields_increment + '" href="#"><i class="fa fa-times fa-lg text-danger"></i> <?=$this->getTrans("remove")?></a></div></div>');
            additional_fields_increment += 1;
        });

        var rounds_container = $('#rounds');

        rounds_container.delegate('.round_destroy', 'click', function(e){
            e.preventDefault();
            $("#" + $(this).data('destroy')).remove();
        });

        var rounds_increment = 1;

        $('#rounds_add').click(function(e){
            e.preventDefault();
            rounds_container.append('<div id="round' + rounds_increment + '"><div class="form-group"><div class="col-sm-5 col-sm-offset-1"><input placeholder="<?=$this->getTrans("roundname")?>" type="text" class="form-control" name="match[rounds][' + rounds_increment + '][name]"></div><div class="col-sm-3"><a class="btn btn-default round_destroy" data-destroy="round' + rounds_increment + '" href="#"><i class="fa fa-times fa-lg text-danger"></i> <?=$this->getTrans("remove")?></a></div></div><div class="form-group"><div class="col-sm-2 col-sm-offset-1"><input placeholder="<?=$this->getTrans("points_home")?>" type="text" class="form-control text-center" name="match[rounds][' + rounds_increment + '][home]"></div><div class="col-sm-1 text-center">:</div><div class="col-sm-2"><input placeholder="<?=$this->getTrans("points_guest")?>" type="text" class="form-control text-center" name="match[rounds][' + rounds_increment + '][guest]"></div></div><div class="form-group"></div></div>');
            rounds_increment += 1;
        });
    });
</script>
