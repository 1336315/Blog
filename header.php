<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
  <nav id="navbar">

    <label for="hamburguer-toggle" class="menu-icon"><i class="fas fa-bars"></i>
    <input type="checkbox" id="hamburguer-toggle"/>
    <ul class="hamburguer-items">
      <li><a href="login.php">Login</a></li>
      <li><a href="signin.html">Sign Up</a</li>
      <li><a href="about.php">About</a></li>  
     </ul>
    </label>

   <a href="index.php" id="pagetitle"style="text-decoration: none;">The Blog</a>
    
      <div id="bar"></div>   
          <span class="material-symbols-outlined">
          search
          </span> 
          <input type="search" name="SearchBar" class="searchbar" placeholder="Search...">
     
      
    
    
      
      </div>    
      
    
  </nav>
  <div class="searchresults" style="position:relative; margin-top:0px;" >
              <script>
              //Step 1- See if the user typed anything at the search bar, if not, do nothing
                const searchquery = document.querySelector('.searchresults');
                const searchbox = document.querySelector('.searchbar');

                searchbox.onkeyup = function(){
                var entry = document.querySelector('.searchbar').value;
                console.log(entry);
                var entryspace = entry.replace(/ /g, '_');
                

                //Step 2- If it is typed, see if something in database has what the user typed(this is where AJAX comes in)
                //It won't access from here
                if (entryspace){
                  //console.log('you have an entry typed in');
                  var ajx = new XMLHttpRequest();
                  ajx.open("GET", 'searchbar.php?s='+ entryspace,true);
                    

              //Step 3- If there is, display something, if not, display nothing
                    ajx.onreadystatechange = function() {
                      if (ajx.readyState === 4 && ajx.status === 200) {
                        var answer = ajx.responseText;
                        console.log(answer);
                        searchquery.innerHTML= answer;
                      } 
                    } 
                    

                    ajx.send();
                    console.log(ajx);
                    
                  }
        
                //Step 3- If there is, display something, if not, display nothing
                  
                }      
              </script>      
  </div>            

  
