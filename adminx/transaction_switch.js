var crypto_item =document.querySelector(".crypto_items");
    var giftcard_item =document.querySelector(".giftcard_items");
    var utility_item =document.querySelector(".utility_items");
    
    var b_transaction = document.querySelectorAll(".b_transaction");
    for(var j=0; j<3; j++){

        b_transaction[0].onclick=function(){
            window.alert("aaaa");
            b_transaction.forEach(function(b){
                b.classList.remove("active");
            });
            b_transaction[j].classList.add("active");
        }
    }
           
           b_transaction[0].onclick=function(){
           crypto_item.style.display="block";
           giftcard_item.style.display="none";
           utility_item.style.display="none"; 

            b_transaction[1].classList.remove("active");
            b_transaction[2].classList.remove("active");
            b_transaction[0].classList.add("active");
        }
        b_transaction[1].onclick=function(){
           crypto_item.style.display="none";
           giftcard_item.style.display="block";
           utility_item.style.display="none"; 

           b_transaction[0].classList.remove("active");
            b_transaction[2].classList.remove("active");
            b_transaction[1].classList.add("active");
        }
        b_transaction[2].onclick=function(){
           crypto_item.style.display="none";
           giftcard_item.style.display="none";
           utility_item.style.display="block"; 

           b_transaction[1].classList.remove("active");
            b_transaction[0].classList.remove("active");
            b_transaction[2].classList.add("active");
        }