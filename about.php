<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
</head>
<style>
    body{
        font-family: 'Playfair Display',serif;
            padding: 0;
            background-color: #ABD6EB;
            margin: 0;;
        scroll-behavior: smooth;
    }
    header{
        background-color:rgb(240, 247, 248);
        color: #109fc3;
        background-image:url(web.webp);
        background-size: cover;
        text-align: center;
        padding: 10px 20px 50px 0px;
        position: relative;
        overflow: hidden;
    }
    header .hero h1 span{
        font-size: 40px;
        color:blue;
    }
    header .hero p{
        font-size:23px;
    }
    header .btn{
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #109fc3;
        color:black;
        text-decoration: none;
        font-weight: bold;
        border-radius: 5px;
        transition: background 0.3s ease,transform 0.3s ease;
    }
    header .btn:hover{
        
        background-color: #446575;;
        color:rgb(117, 147, 239);
        transform: scale(1.1);
    }

    header .btn:hover{
        background-color:rgb(240, 247, 248);
        color:rgb(85, 125, 165);
    }
    .btn{
        font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;

    }


    .user-need{
        display:flex;
        justify-content:flex-end;
       
        
    }
    .user-need a{
        text-decoration:none;
        border-radius: 5px;
    }
   
    nav ul{
        list-style: none;
        margin: 0;
        padding: 10px 0;
        display: flex;
        justify-content: center;
        background: #109fc3;
        color: white;
    }
    nav ul li{
        margin:0 45px;
       
        
    }
    nav ul li a{
        color: rgb(255, 246, 246);
        text-decoration: none;
        font-size: 1.2rem;
        transition: color o.3s ease;
        font-size: 25px;
    }
    nav ul li a:hover{
        background-color: #ABD6EB;
            color:rgb(13, 33, 254); 
	        transform: scale(1.3);
    }
    .section{
        padding: 50px 20px;
        text-align: center;
        background:whitesmoke;
        margin: 20px 0;
        opacity: 0;
        transform: translateY(30px);
        animation: slidein 1s ease-in-out forwards;
    }
    .projects{
        display: flex;
        justify-content: center;
        gap: 50px;
        flex-wrap: wrap;
    }
    .projects h3{
        color: rgb(255, 255, 255);
        font-size: 18px;
    }
    h2{
        color: red;
    }
    p{
        color: rgb(77, 94, 110);
        font-size: 19px;
    }
    .project-card{
        background:   #ABD6EB;
        color: rgb(255, 255, 255);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px  rgb(0,0,0,0.1);
        transition: transform 0.9 ease,box-shadow 0.6s ease;
        width: 300px;
    }
    .hero a{
        color:white;
    }
   
    .project-card:hover{
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgb(0,0,0,0.2);
    }
    @keyframes fadein{
        from{
            opacity: 0;
            transform: translateY(-30px);
        }
        to{
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes slidein{
        from{
            opaity:0;
            transform: translateY(30px);
        }
        to{
            opacity: 1;
            transform: translateY(0);
        }
    }
    .footer {
            background-color: #f1f3f4;
            color: #201f1f;
            text-align: center;
            padding: 2px;
            
        }
    @media(max-width:768px){
        .projects{
            flex-direction: column;
            align-items: center;
        }
        .project-card{
        width: 70%;
    }
    }
    .section slide-in p{
        font-size: 15px;
    }
    
.images {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;

}

.images img {
  max-width: 295px;
  height: auto;
  border-radius: 5px;
}
button {
  background-color:  #ABD6EB;
  color: white;
  padding: 1px 2px;
  border: none;
  border-radius: 50px;
  cursor: pointer;
}
button:hover{

            transform: scale(1.1)
        }

</style>
<body>
    <header>

        <div class="user-need">
            <button><a href="index.php"><p>back to home</p></a></button>
           
        </div>


        <div class="hero">
            <h1 class="fade-in">Hello,It's me <span>Seferina Niha</span></h1>
            <p class="fade-in">And I am a Information Technology Student.</p>
            <a href="#about" class="btn">Discover More</a>
        </div>
    </header>
    <nav>
       <ul>
        <li><a href="#about">About</a></li>
        <li><a href="#projects">Projects</a></li>
        <li><a href="#contact">Contact</a></li>
       </ul>
    </nav>
    <section id="about" class="section slide-in">
        <h2>About me</h2> 
        <p> Hi there! I'm Newbie Web Developer with no experience. don't worry, I'm practicing to create a website and improve my fronted skills.</p>
    </section>
    <section id="projects" class="section slide-in">
        <h2>How to Discover Cribotics!</h2>
        <div class="projects">
            <div class="project-card hover-grow">
                <h3>Go to Search Bar</h3>
                <div class="images">
               
            </div>
            </div>
            <div class="project-card hover-grow">
                <h3>Search Cribotics</h3>
                <div class="images">
              
            </div></div>
            <div class="project-card hover-grow">
                <h3>Enjoy Shopping</h3>
                <div class="images">
              
            </div> 
        </div>
    </section>
    <section id="contact" class="section slide-in">
        <h2>Contact Me</h2>
        <p>Email:cribotics@gmail.com</p>
        <p>Phone:+63876543543</p>
    </section>
    <div class="footer">
        <p>&copyCopyright 2024. All Rights Reserved.</p>
    </div> 
</div>

</body>
</html>