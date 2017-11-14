var $ = function(id) {
    return document.getElementById(id);
}; //short notation of getting element's ID


var makeid = function() { //radomly selects whether X or O plays first using math.random() function
    var text = "";
    var possible = "XO";

    for (var i = 0; i <= 0; i++)
        text += possible[Math.floor(Math.random() * possible.length)];

    return text;
};

var piece = makeid(); //random x/o global var. 
var winning_piece = null; //used to end game after winning piece (X/O) 
var cpu_mode = false;
var lock = false;
cpu_piece = "O";
var c = 0;
var timer;
var counter = 0;

var timer;

var begin_game_message = function() { //print player's turn in the beginning 
    timer = setInterval(function() { //cue time 
        counter++;
        $("counter").innerHTML = counter;

    }, 1000);
    if (cpu_mode === true) { //if in CPU mode & "Piece"==O , then que CPU to go first 
        if (piece === "O") {
            alert("CPU goes first");
            AI();
            switch_mv();

        } else {
            alert("Player" + " " + "goes first");
            display_turn(piece + "'s" + " " + "turn");
        }
    } else {
        alert("Player" + " " + piece + " " + " goes first");
        display_turn(piece + "'s" + " " + "turn to play"); //display player's turn
    }
};

var display_turn = function(t) { // display message in designated position (by specified id name)
    var val = $("turn");
    val.innerHTML = t;
};

var AI = function() {
    if (cue_play_agn != true) {
        var run = true;
        var t = false;
        var x_count = 0;
        var o_count = 0;
        var opp_sel = document.getElementsByTagName("td"); //get all cells from table
        var pos = Math.floor((Math.random() * 9) + 0); //randomly position "O" mark when cpu plays 
        while (run) {
            for (var i = 0; i < 9; i++) {
                if (opp_sel[i].innerText === "X") {
                    x_count++;
                } else if (opp_sel[i].innerText === "O") {
                    o_count++;
                }
            }
            if (opp_sel[pos].innerText === "") {
                opp_sel[pos].innerText = cpu_piece;
                break;
            } else if (x_count === 4 && o_count === 4) {
                for (var i = 0; i < 9; i++) {
                    if (opp_sel[pos].innerText == "") {
                        opp_sel[i].innerText = "O";
                        break;
                    }
                }
            } else if (x_count === 5 && o_count === 4 || o_count === 5 && x_count === 4) { //if CATS occurs 
                break;
            } else {
                var pos = Math.floor((Math.random() * 9) + 0); //randomly position "O" mark when cpu plays 
                x_count = 0;
                o_count = 0;
            }
        }
    } else {
        return false;
    }
};
var cpu_clicked = function() { //sets condition when in plyr. vs. plyer mode 
    var c = 0;
    var cp = $("cpu");
    if (cp.checked) {
        c++;
        cpu_mode = true;
        return true;
    } else if (c === 0) {
        return false;
    }
};

var mouse_dwn = function() { // statement to engange player v. player mode 
    c++;
    lock = true;
    cpu_clicked();
    if (c === 2) { //restart if start/restart button clicked again (after intial click to begin game)
        restart_();
    }
};

var restart_ = function() //restart game 
    {
        cue_play_agn = true;
        window.location.reload(true);

    };
var place = false;
var next_mv_plr = function(block) { // write player game piece on open tile (plyr. v. plyr)
    if (lock === true) { //lock precaution so user clicks on start button prior to filling out board w/ game piece 
        if (cpu_mode != true) {
            if (winning_piece != null) {
                display_turn(piece + " " + "has won already, game is over.");
            } else if (block.innerHTML == "") { //determine if tile is empty for user to enter in

                var v = piece; //set current piece (either X or O perf. by random function) to variable ve
                block.innerText = v; //write player's piece on tile              
                window.setTimeout(switch_mv, 300);

            } else {
                alert("!!! this spot is already taken!!!");
            }
        } else { //CPU V. PLYR mode 
            if (piece === "X") {
                if (winning_piece != null) {
                    display_turn(piece + " " + "has won already, game is over.");
                } else if (block.innerHTML == "") { //determine if tile is empty for user to enter in

                    block.innerText = "X"; //write player's piece on tile
                    switch_mv();
                    AI(); //cpu performs right after
                    window.setTimeout(switch_mv, 300);
                } else {
                    alert("!!! this spot is already taken!!!");
                }
            }
        }
    }
};

var cue_play_agn = false;
var ply_again = function() { //button to play again only after game has ended 
    var ans = window.confirm("Play again?");
    if (ans) {
        x = true;
        window.location.reload(true);
    } else {
        clearInterval(timer);
    }
};
var switch_mv = function() { //toggle b/t X/Os when taking turns while also checing to see if win/draw has occured

    if (det_win(piece)) {
        clearInterval(timer);
        alert(piece + " " + "wins!");
        cue_play_agn = true;
        ply_again();
        winning_piece = piece;
        return true;
    } else if (det_tie() == true) { //if tie has occured, prompt user a tie has happened
        alert("The game has ended in a Draw!");
        cue_play_agn = true;
        ply_again();
        return true;

    } else if (cpu_mode != true) {
        if (piece == "X") {
            piece = "O";
            display_turn(piece + "'s" + " " + "turn");

        } else if (piece == "O") {
            piece = "X";
            display_turn(piece + "'s" + " " + "turn");

        }
    } else {
        if (piece === "X") {
            display_turn("O's turn");
            piece = "O";

        } else {
            display_turn("X's turn");
            piece = "X";

        }
    }

};


var get_tile = function(til) { // get current tile value to check for win (pt.1)
    var tilee = $(til).innerText;
    return tilee;
};

var det_match = function(c1, c2, c3, current) { // if all three tile values match -> return "set" = 1 (win)
    var set = 0;

    if (get_tile(c1) == current && get_tile(c2) == current && get_tile(c3) == current) {
        set = 1;
    }
    return set;
};

var det_tie = function() { // scan board and determine if there is a tie
    var num = 0;
    for (var i = 0; i < 9; i++) {
        if (get_tile(i) === "") { // if each cell has not been filled in yet, set result to false
            num++;
        }
    }
    if (num === 0) {
        return true;
    } else {
        return false;
    }
};


var det_win = function(current) { //check all possible winning options 
    var win = false;
    if (
        det_match(0, 1, 2, current) ||
        det_match(3, 4, 5, current) ||
        det_match(6, 7, 8, current) ||
        det_match(0, 3, 6, current) ||
        det_match(1, 4, 7, current) ||
        det_match(2, 5, 8, current) ||
        det_match(0, 4, 8, current) ||
        det_match(2, 4, 6, current)) {
        win = true;

    }

    return win; //return win var. if 0 - no win. 1- indicates win 
};



window.onload = function() {
    var btn = $("start_bt");
    var getss =
        btn.addEventListener("click", begin_game_message);


};