<?php
require_once 'system/connection.php';
$query_count = mysqli_query($connection, "SELECT * FROM tbl_setting_2");

$data = array();
$i = 0;
foreach ($query_count as $row) {
    $row_count = $row['row_count'];
    $kategori = $row['kategori'];
    $i++;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Fun Run 2023</title>
    <link rel="shortcut icon" href="img/crr.png">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
    <link href="css/full_pesawat.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@600&display=swap" rel="stylesheet">


</head>

<body>
    <!-- Navigation -->
    <?php include('system/menu.php') ?>
    <!-- Page Content -->
    <!-- <div style="width:100%">
        <div class="d-flex justify-content-center">
            <div class="d-flex justify-content-around align-items-center">
                <div class="title" style="width:max-content;">
                    <h1 class="text-white" style="font-size:50px; ">RAKER CNN INDONESIA</h1>
                </div>

                <div class="title text-center">
                    <img src='img/logo_cnnid.png' class="img-fluid" width="50%" style="display:inline-block;">
                </div>

                <div class="title" style="width:max-content;">
                    <h1 class="text-white" style="font-size:50px; ">RAKER CNN INDONESIA</h1>
                </div>
            </div>

        </div>
    </div> -->
    </br></br></br></br></br></br>

    <div class="auto-container" style="margin-top:5rem;">
        <canvas id='confeti' width="100%" height="100%"></canvas>


        <div class="auto-container">
            <div class="col-lg-12 text-center ">
                <div id="info" class="info ">
                    <!-- <h1 style="color:#000;"><b style="font-size:52px;">Pressed Space for Draw ! <?php //echo $kategori 
                                                                                                        ?></b></h1>-->
                    <h1 style='color:Black' class='who-text'> <img class='badge-who'><b>Who is the lucky one....!</b></h1>
                </div>
                </br>
                <!--<h1 style="color:#000;" id="ttl_prz"><?php echo $kategori . ' total = ' . $row_count ?></h1>-->
                <div id="nomor" class="auto-container row d-flex justify-content-center mt-2">


                    <?php for ($i = 0; $i < $row_count; $i++) {

                        echo '<div class="mt-1 pemenang" style="width:400px;><h6 style="color:Black" id="row_' . $i . '"></h6></div>';
                        echo '<input id="id_' . $i . '" type="hidden">';
                        echo '<input id="kategori" value="' . $kategori . '" type="hidden">';
                    } ?>
                </div>

                <input id="id" type="hidden">
                <div class="col-12"></div>

                <div id="button" class="congrats">
                    <button id="start" class="btn btn-lg btn-success start" type="button" name="button" hidden><i class="fa fa-play"></i> Start</button>
                    </br>
                    <button id="stop" class="btn btn-lg btn-danger congratsButton" type="button" name="button" hidden><i class="fa fa-stop"></i> Stop</button>
                    </br>
                    <!-- <button id="reset" class="btn btn-lg btn-default reset" type="button" name="button"><i
                            class="fa fa-refresh"></i> Reset</button> -->
                </div>

            </div>
        </div>
    </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        var i, j, temp, pop, col, chunk = <?= $row_count ?>;
        var rand;
        var idx = [];
        var chosen = [];
        var res = [];
        var counter = 0;


        function getCol(matrix, col) {
            var column = [];

            for (var i = 0; i < matrix.length; i++) {
                column.push(matrix[i][col]);
            }

            return column;
        }

        function chunkArray(myArray, chunk_size) {
            var index = 0;
            var arrayLength = myArray.length;
            var tempArray = [];
            var col = [];
            var res = new Array();

            for (index = 0; index < arrayLength; index += chunk_size) {
                myChunk = myArray.slice(index, index + chunk_size);
                // Do something if you want with the group
                tempArray.push(myChunk);
            }

            for (var i = 0; i < chunk_size; i++) {
                col[i] = getCol(tempArray, i);
            }

            return col;
        }

        function get_random(i) {
            return setInterval(function() {
                var id = Math.floor(Math.random() * pop[i].length);
                var y = i + 1
                $("#ttl_prz").hide();
                $("#row_" + i).html(
                    '<img src="img/bg_nama.png" class="bg_nama">' +
                    '<h6 style="color:#000; font-size:15px; padding-top:120px " class="nomor_telepon">' + pop[i][id]['nama'] + '</h6>' +
                    '</h6> <h6 style="color:#000; font-size:10px;" class="nama_divisi">' + pop[i][id]['email'] + '</h6>');
                //'<h6 style="color:#000; font-size:20px;" class="nama_divisi">' + pop[i][id]['divisi'] + '</h6>');
                $("#id_" + i).val(pop[i][id]['id']);
            }, 5);
        }

        //initial hide
        $("#stop").hide();
        $("#reset").hide();

        //starting
        document.body.onkeydown = function(e) {
            if (e.keyCode == 32) {

                counter++;
                if (counter % 2 == 1) {
                    //  alert('odd');
                    $("#start").hide();
                    $("#stop").show();
                    // $("#info").html("<h1 style='color:Black'>Who is the lucky one.... Press Space to Stop !</h1>");
                    $("#info").html("<h1 style='color:Black' class='who-text'> <img class='badge-who'>Who is the lucky one....!</h1>");
                    $.ajax({
                        type: 'post',
                        url: 'system/get_nomor.php',
                        dataType: 'json',
                        async: 'false',
                        success: function(data) {
                            temp = data;
                            if (temp.length == 0) {
                                $("#stop").hide();
                                $("#start").show();
                                for (var i = 0; i < chunk; i++) {
                                    $("#row_" + i).html('--');
                                    $("#id_" + i).val('');
                                }
                                $("#info").html("<h1 style='color:Black'><b>Pressed Space for Draw !</b></h1>");
                                alert('All data have been chosen!');
                            } else {
                                pop = chunkArray(temp, chunk);
                                for (var i = 0; i < chunk; i++) {
                                    res[i] = get_random(i);
                                }
                            }
                        }
                    })
                } else {
                    //  alert('even');
                    if (e.keyCode == 16) {
                        return false;
                    } else {
                        $("#stop").hide();
                        $("#reset").show();

                        var ids = new Array();
                        var kategoris = '';
                        var dataString = '';
                        for (var i = 0; i < chunk; i++) {
                            clearInterval(res[i]);
                            ids.push($("#id_" + i).val());
                            kategoris = $("#kategori").val();
                        }

                        dataString += 'id' + '=' + ids + '&' + 'kategori' + '=' + kategoris + '&';

                        // alert(dataString);

                        $.ajax({

                            type: 'post',
                            url: 'system/update_nomor.php',
                            data: dataString,
                            success: function() {

                            }
                        })

                        $("#info").html(
                            "<h1 style='color:Black' class='text-center row d-flex justify-content-center congrats-text'><img class='badge-congrats'><b>CONGRATULATIONS !!!</b></h1>"
                        );
                        $("#confeti").show();
                    }
                }


            }
        }

        //stopping
        document.onkeydown = function(evt) {
            var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
            if (keyCode == 16) {
                // $("#start").show();
                // $("#reset").hide();
                // for (var i = 0; i < chunk; i++) {
                //     $("#row_" + i).html('--');
                //     $("#id_" + i).val('');
                // }
                // $("#info").html(
                //     "<h1 style='color:Black' class='text-center row d-flex justify-content-center'><b style='font-size:52px;'>Pressed Space for Draw !</b></h1>"

                // );
                // $("#ttl_prz").show();
                // $("#ttl_prz").html(
                //     "<h1 style='color:Black' id='ttl_prz'><?php //echo $kategori . ' total = ' . $row_count 
                                                                ?></h1>"
                // );
                // alert('reset');

                alert('reset');
                location.reload();
                $("#confeti").show();



            }
        }
        //ini perubahan




        //confetti
        $(document).ready(function() {
            //list item interaction
            var listSwipeStarted = 0,
                startSwipeX = 0,
                newSwipePosX = 0,
                currentListItem = "",
                listItem = $(".listItem");


            $("body").on("touchstart", ".listItem", function(e) {
                currentListItem = $(this).index();

                //get starting position
                startSwipeX = e.originalEvent.touches[0].pageX;

                //swipe hint
                listItem.eq(currentListItem).addClass("slideHint");

                listSwipeStarted = 1;

            }).on("mousedown", ".listItem", function(e) {
                currentListItem = $(this).index();

                //get starting position
                startSwipeX = e.pageX;

                //swipe hint
                listItem.eq(currentListItem).addClass("slideHint");

                listSwipeStarted = 1;

                // }).on( "mousemove", function(e) {
                //     e.preventDefault();

                //     if (listSwipeStarted === 1){
                //         newSwipePosX    = e.pageX - startSwipeX;
                //     }

                //     listItem.eq(currentListItem).velocity({  
                //         translateX: newSwipePosX
                //     }, { queue: false, duration: 10 }); 
                // }).on( "touchmove", function(e) {
                //     e.preventDefault();

                //     if (listSwipeStarted === 1){   
                //         newSwipePosX = e.originalEvent.touches[0].pageX - startSwipeX;
                //     }

                //     listItem.eq(currentListItem).velocity({  
                //         translateX: newSwipePosX
                //     }, { queue: false, duration: 10 }); 
                // }).on( "touchend mouseup", function(e) {
                //     e.preventDefault();

                //     listItem.eq(currentListItem).removeClass("slideHint");

                //     if (newSwipePosX >= 120){
                //         //shrink away the list item
                //         listItem.eq(currentListItem).velocity({  
                //             height: 0
                //         }, { queue: false, duration: 600, easing: [0.4, 0, 0.2, 1] }).velocity({  
                //             translateX: "100%"
                //         }, { queue: false, duration: 200, easing: [0.4, 0, 0.2, 1] });

                //     } else if (newSwipePosX <= -120){
                //         //shrink away the list item
                //         listItem.eq(currentListItem).velocity({  
                //             height: 0
                //         }, { queue: false, duration: 600, easing: [0.4, 0, 0.2, 1] }).velocity({  
                //             translateX: "-100%"
                //         }, { queue: false, duration: 200, easing: [0.4, 0, 0.2, 1] });
                //     } else{
                //         //reset position
                //         listItem.eq(currentListItem).velocity({  
                //             translateX: 0,
                //         }, { queue: false, duration: 200, easing: [0.4, 0, 0.2, 1] });  
                //     }

                //reset swipe position
                newSwipePosX = 0;
                listSwipeStarted = 0;
            });
        });

        //force refresh of confetti
        $(".congratsButton").one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
            function(e) {
                var canvas = document.getElementById("confeti");
                canvas.style.display = 'none';
                canvas.offsetHeight;
                canvas.style.display = 'none';
            }).click(function() {
            var canvas = document.getElementById("confeti");
            canvas.style.display = 'show';
            canvas.offsetHeight;
            canvas.style.display = 'show';
        });


        $(".start").one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
            var canvas = document.getElementById("confeti");
            canvas.style.display = 'none';
            canvas.offsetHeight;
            canvas.style.display = 'none';
        }).click(function() {
            var canvas = document.getElementById("confeti");
            canvas.style.display = 'none';
            canvas.offsetHeight;
            canvas.style.display = 'none';
        });


        $(".reset").one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
            var canvas = document.getElementById("confeti");
            canvas.style.display = 'show';
            canvas.offsetHeight;
            canvas.style.display = 'show';
        }).click(function() {
            var canvas = document.getElementById("confeti");
            canvas.style.display = 'none';
            canvas.offsetHeight;
            canvas.style.display = 'none';
        });


        $(".info").one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
            var canvas = document.getElementById("confeti");
            canvas.style.display = 'none';
            canvas.offsetHeight;
            canvas.style.display = 'none';
        }).click(function() {
            var canvas = document.getElementById("confeti");
            canvas.style.display = 'none';
            canvas.offsetHeight;
            canvas.style.display = 'none';
        });

        (function() {
            var COLORS, Confetti, NUM_CONFETTI, PI_2, canvas, confetti, context, drawCircle, drawCircle2, drawCircle3,
                i, range, xpos;

            NUM_CONFETTI = 60;

            COLORS = [
                [255, 255, 255],
                [240, 83, 85],
                [255, 255, 255],
                [240, 83, 85],
                [0, 277, 235]
            ];

            PI_2 = 2 * Math.PI;

            canvas = document.getElementById("confeti");

            context = canvas.getContext("2d");

            window.w = 900;

            window.h = 675;

            window.resizeWindow = function() {
                window.w = canvas.width = window.innerWidth;
                return window.h = canvas.height = window.innerHeight;
            };

            window.addEventListener('resize', resizeWindow, false);

            window.onload = function() {
                return setTimeout(resizeWindow, 0);
            };

            range = function(a, b) {
                return (b - a) * Math.random() + a;
            };

            drawCircle = function(x, y, r, style) {
                context.beginPath();
                context.moveTo(x, y);
                context.bezierCurveTo(x - 17, y + 14, x + 13, y + 5, x - 5, y + 22);
                context.lineWidth = 3;
                context.strokeStyle = style;
                return context.stroke();
            };

            drawCircle2 = function(x, y, r, style) {
                context.beginPath();
                context.moveTo(x, y);
                context.lineTo(x + 10, y + 10);
                context.lineTo(x + 10, y);
                context.closePath();
                context.fillStyle = style;
                return context.fill();
            };

            drawCircle3 = function(x, y, r, style) {
                context.beginPath();
                context.moveTo(x, y);
                context.lineTo(x + 10, y + 10);
                context.lineTo(x + 10, y);
                context.closePath();
                context.fillStyle = style;
                return context.fill();
            };

            xpos = 0.9;

            document.onmousemove = function(e) {
                return xpos = e.pageX / w;
            };

            window.requestAnimationFrame = (function() {
                return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window
                    .mozRequestAnimationFrame || window.oRequestAnimationFrame || window
                    .msRequestAnimationFrame || function(callback) {
                        return window.setTimeout(callback, 100 / 20);
                    };
            })();

            Confetti = (function() {
                function Confetti() {
                    this.style = COLORS[~~range(0, 5)];
                    this.rgb = "rgba(" + this.style[0] + "," + this.style[1] + "," + this.style[2];
                    this.r = ~~range(2, 6);
                    this.r2 = 2 * this.r;
                    this.replace();
                }

                Confetti.prototype.replace = function() {
                    this.opacity = 0;
                    this.dop = 0.03 * range(1, 4);
                    this.x = range(-this.r2, w - this.r2);
                    this.y = range(-20, h - this.r2);
                    this.xmax = w - this.r;
                    this.ymax = h - this.r;
                    this.vx = range(0, 2) + 8 * xpos - 5;
                    return this.vy = 0.7 * this.r + range(-1, 1);
                };

                Confetti.prototype.draw = function() {
                    var ref;
                    this.x += this.vx;
                    this.y += this.vy;
                    this.opacity += this.dop;
                    if (this.opacity > 1) {
                        this.opacity = 1;
                        this.dop *= -1;
                    }
                    if (this.opacity < 0 || this.y > this.ymax) {
                        this.replace();
                    }
                    if (!((0 < (ref = this.x) && ref < this.xmax))) {
                        this.x = (this.x + this.xmax) % this.xmax;
                    }
                    drawCircle(~~this.x, ~~this.y, this.r, this.rgb + "," + this.opacity + ")");
                    drawCircle3(~~this.x * 0.5, ~~this.y, this.r, this.rgb + "," + this.opacity + ")");
                    return drawCircle2(~~this.x * 1.5, ~~this.y * 1.5, this.r, this.rgb + "," + this
                        .opacity + ")");
                };

                return Confetti;

            })();

            confetti = (function() {
                var j, ref, results;
                results = [];
                for (i = j = 1, ref = NUM_CONFETTI; 1 <= ref ? j <= ref : j >= ref; i = 1 <= ref ? ++j : --j) {
                    results.push(new Confetti);
                }
                return results;
            })();

            window.step = function() {
                var c, j, len, results;
                requestAnimationFrame(step);
                context.clearRect(0, 0, w, h);
                results = [];
                for (j = 0, len = confetti.length; j < len; j++) {
                    c = confetti[j];
                    results.push(c.draw());
                }
                return results;
            };

            step();

        }).call(this);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>
</body>

</html>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Quicksand', sans-serif;

    }
</style>