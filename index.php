<?php
error_reporting(0);
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Live chat</title>
    <link rel="stylesheet" href="chat.css" />
    <link rel="stylesheet" href="navigation.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  </head>
  <body>

  <div id="header__container">
  <div class="header__content">
   <div>logo</div>
   <nav class="header__nav">
     <ul class="header__nav--items">
       <li class="header__nav--item"><a href="#"></a>Home</li>
       <li class="header__nav--item"><a href="#"></a>About</li>
       <li class="header__nav--item"><a href="#"></a>Services</li>
       <li class="header__nav--item"><a href="#"></a>Contact</li>
     </ul>
   </nav>
  </div>
</div>

<div  class="sidebar">
  <div class="sidebar__nav">
   <div class="sidebar__items">
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
   </div>
  </div>

</div>


<div class="main__content">
    content
  </div>


  <div id="container" class="container default">
    <div class="container__header">
      <p class="header__text">larronshalley live support</p>
      <img src="img/full-screen-icon.png" alt="Full Screen" onclick="toggleModal()" class="icon">
      <span>💬</span>
    </div>
    <div class="chat__messages" id="chat__messages">
      <div id="rdata" class="chat__message"></div>
    </div>
    <button class="scrollCountDown" id="scrollCountDown" onclick="scrollCountDown('#scrollCountDown')">
    </button>
    <p id="alert"></p>
    <div class="chat__form">
      <textarea
        type="text"
        onkeypress="enter(e)"
        name="insertname"
        id="name"
        placeholder="Start typing a message..."
        class="chat__input"
      ></textarea>
      <input
        onclick="rdata('insertdata')"
        name="insertdata"
        value=""
        class="chat_button"
        id="send"
        type="submit"
      />
    </div>
  </div>
<div class="button-down" id="toggleBtn" onclick="toggleButton()">
  <div class="lvIcon textLive"><p>Live Chat</p></div>
  <div class="lvIcon btnLive"></div>
</div>
<div id="overlay"></div>
    <script src="js/chat.js"></script>
  </body>

</html>