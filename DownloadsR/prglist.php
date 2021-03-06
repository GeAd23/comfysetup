@media all and (min-width: 250px) and (min-height: 350px) {

    html *{
        font-family: 'PT Mono', monospace;
    }
    body{
        background-image: url("../media/background.png");
    }
        .sidebar{
            position: absolute;
            left: 0%;
            top: 0%;
            height:100%;
            width:3%;
            background-color: #121212;
        }

        .sidebar img{
            width:50%;
            height:3%;
            padding-left: 25%;
            padding-top: 20%;
            margin: auto;
            cursor: pointer;
        }

        .topbar{
            position: absolute;
            width:97%;
            height: 7%;
            right:0%;
            top:0%;
            background-color: #121212;
            transition: 0.5s;
        }

        .topbar img{
            height:80%;
            width: 7%;
        }

        #logo{
            position: relative;
            left: 1%;
            top: 10%;
            bottom: 10%;
            image-rendering: auto;
            transition: 0.5s;
        }

        /* The side navigation menu */
        .sidenav {
            height: 100%; /* 100% Full-height */
            width: 0; /* 0 width - change this with JavaScript */
            position: fixed; /* Stay in place */
            z-index: 1; /* Stay on top */
            top: 0; /* Stay at the top */
            left: 0;
            background-color: #121212; /* Black*/
            overflow-x: hidden; /* Disable horizontal scroll */
            padding-top: 60px; /* Place content 60px from the top */
            transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
        }

        /* The navigation menu links */
        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.5s;
        }

        /* When you mouse over the navigation links, change their color */
        .sidenav a:hover {
            color: #f1f1f1;
        }


        /* Position and style the close button (top right corner) */
        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
        
        .sidenav .haltdeinefressejulien{
            color: #818181;
            font-size: 15px;
            text-indent: 10px;
        }


        #info {
            position: absolute;
            transition: 0.5s;
            height: 400px;
            width: 1490px;
            top: 7%;
            left: 3%;
        }
        
        #login{
            opacity: 60%;
            background-color: #121212;
            width: 30%;
            height: 50%;
            top: 50%;
            position: relative;
            margin: 0 auto;
            border-radius: 5px;
        }
        #login form{
            margin: 0 auto;
            position: relative;
            padding-top: 10px;
            padding-left: 40px;
                }
        
        #login input{
            border: 1px solid;
            border-radius: 5px;
            font-size: 20px;
            width: 90%;
            height: 40px;
            margin: 10px 0;
            background-color: #121212;
            border-color:#818181;
            color: #818181;
        }
        #login input:hover{
            color: white;
            border-color: white;
        }

        #login input[type=submit]{
            background-color: #a23d74;
            color: white;
            border-radius: 5px;
            border-color: #818181;

        }

        #login input[type=submit]:hover{
            background-color: #b54481;
            border-color: white;
            font-size: 20px;           

        }
        
        #usrprglist{
            background-color: #121212;
            opacity: 60%;
            border-radius: 5px;
             
        }
            

@media all and (max-width: 450px){
    #content{
        display: none;
        background-color: #121212;
    }
    
}
}
