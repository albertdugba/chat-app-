<?php require_once "includes/session_monitor.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>alpha</title>
    <link rel="stylesheet" href="chat.css" />
    <link rel="stylesheet" href="css/navigation.css" />
    <link rel="stylesheet" href="mediaQueries.css" />
    <link rel="stylesheet" href="css/styles.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/chat.js"></script>
</head>

<body>


    <div class="sidebar">
        <div class="sidebar__nav">
            <div>
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>"><img
                        data-img="https://www.laronshalley.com/icons/alphalogo.png" class="alphalogo" /></a>
            </div>
            <div class="sidebar__items">
                <ul>
                    <li class="sidebar__item">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="sidebar__item">
                        <a href="#">Orders</a>
                    </li>
                    <li class="sidebar__item">
                        <a href="#">Payments</a>
                    </li>
                    <li class="sidebar__item">
                        <a href="#">Account</a>
                    </li>
                    <li class="sidebar__item">
                        <a href="#">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main__content">
            <div class="topnavigation">
                <div>
                    <ul>
                        <li>
                            <div class="proImage">
                                <div>
                                    <p><?php echo $_SESSION['u_name'] ?></p>
                                </div>
                                <div class="profile_image"><img data-img="img/index.jpg" /></div>
                            </div>
                            <ul class="optionNav">
                                <li><a href="#">Profile</a></li>
                                <li><a href="includes/logout.php">Logout</a>
                                <li>
                                <li><a href="#">Setting</a>
                                <li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="loadcontent">
                <div class="content contEnt">

                </div>
                <div class="content minidashBoard">

                </div>
            </div>

        </div>
    </div>

    <div id="chatWrapper" class="ChatWrapper default">
        <div id="container" class="container default">
            <div class="container__header">
                <p class="header__text">larronshalley live support</p>
                <img src="img/full-screen-icon.png" alt="Full Screen" onclick="toggleModal()" class="icon" />
                <span>💬</span>
            </div>
            <div class="chat__messages" id="chat__messages">
                <div id="rdata" class="chat__message"></div>
            </div>
            <button class="scrollCountDown" id="scrollCountDown" onclick="scrollCountDown('#scrollCountDown')"></button>
            <p id="alert"></p>
            <div class="chat__form">
                <textarea type="text" onkeypress="enter(e)" name="insertname" id="name"
                    placeholder="Start typing a message..." class="chat__input"></textarea>
                <input onclick="rdata('insertdata')" name="insertdata" value="" class="chat_button" id="send"
                    type="submit" />
            </div>
        </div>
    </div>


    <div class="button-down" id="toggleBtn" onclick="toggleButton()">
        <div class="lvIcon textLive">
            <p>Live Chat</p>
        </div>
        <div class="lvIcon btnLive"></div>
    </div>

    <div id="overlay"></div>
    <?php require_once 'includes/footer.php'?>

</body>

</html>