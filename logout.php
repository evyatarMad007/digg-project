<?php 

session_start();

session_destroy(); // פונקציה פופולרית להתנתקות
// מחיקת הקובץ tmp + מחיקת coocking
// כי אין לנו מושג מתי יחזור המתשמש הזה
// וחבל לאחסן את הנתונים לשלושת החודשים הבאים לשווא

header('location: singin.php');