const displayImage = document.querySelectorAll('.displayImage');
const title = document.querySelectorAll('.title');
const desc = document.querySelectorAll('.desc');
const editIcon = document.querySelectorAll('.editIcon');
const greenCheck = document.querySelectorAll('.greenCheck');
const imgDisplay = document.querySelectorAll('.imgDisplay');
const moveButton = document.querySelectorAll('[data-button]');
const imgExit = document.querySelector('.imgExit');
const popUpImage = document.querySelector('.popUpImage');
const popUpImg = document.querySelector('.popUpImg');
const titleNumber = document.querySelectorAll('.titleNumber');
const descNumber = document.querySelectorAll('.descNumber');
const updateInput = document.querySelectorAll('.updateInput');
const xMark = document.querySelectorAll('.xMark');

function inputCounter(){
 
    for(i=0; i < imgDisplay.length; i++){
        let t = title[i].dataset.tid;
        let d = desc[i].dataset.did;
        let l = titleNumber[i].dataset.cid
        let s = descNumber[i].dataset.sid
        let c = titleNumber[i]
        let a = descNumber[i]
        let max = title[i].getAttribute('maxLength');
        if(t === l){
            titleNumber[i].innerHTML = max - title[i].value.length + "/13";
            if(c.innerHTML === "0/13"){
                c.style.color = "red";
            }else{
                c.style.color = "rgba(177, 175, 175, 0.786)";
            }
    
            }if(d === s){
                descNumber[i].innerHTML = max - desc[i].value.length + "/13";

                if(a.innerHTML === "0/13"){
                    a.style.color = "red";
                }else{
                    a.style.color = "rgba(177, 175, 175, 0.786)";
                    }
        }else{
    
        }
                
    }

}

inputCounter()

updateInput.forEach(function (input){
    input.addEventListener('input', ()=>{
        inputCounter()
    })
})

function showno(){
    title[i].classList.toggle('toggle'); 
    desc[i].classList.toggle('toggle'); 
    title[i].removeAttribute('disabled');
    desc[i].removeAttribute('disabled');
    greenCheck[i].classList.toggle('hide');
    titleNumber[i].classList.toggle('hide');
    descNumber[i].classList.toggle('hide');
    editIcon[i].classList.toggle('vis');
    xMark[i].classList.toggle('vis');
}
    editIcon.forEach(function(btn){
        btn.addEventListener('click', ()=>{

            for(i=0; i < editIcon.length; i++){

               let titleData = title[i].dataset.tid;

                if(btn.dataset.pen === titleData){
                    showno();
                }else{
                }
            }
        });
        
    });
    
imgExit.addEventListener('click', ()=>{
    popUpImage.classList.add('hide');
});

displayImage.forEach(function(btn){
    btn.addEventListener('click',(e)=>{
       if(e.currentTarget){
            let src =  e.currentTarget.src;
            popUpImage.classList.remove('hide');
            popUpImg.src = src;
            console.log(src)
            let le = [...displayImage];
            let counter = le.indexOf(e.currentTarget);

            let title = imgDisplay[counter].children[3].children[0].getAttribute("value");
            let desc = imgDisplay[counter].children[3].children[4].getAttribute("value");
            document.querySelector('.hh').innerHTML = `<h3 class="text margin">${title}</h3><p class="text">${desc}</p>`;       
            number(counter)
            }
 
    })
    
})

function number (counter){
    moveButton.forEach(function(btn){
        btn.addEventListener('click',(e)=>{  

            let right = e.currentTarget.classList.contains( 'right') ? counter++ : counter--;
            
            if(!right && counter < 0) counter = displayImage.length - 1;
            
            if(counter === displayImage.length) counter = 0;
            
            popUpImg.setAttribute('src', displayImage[counter].src);  

            let title = imgDisplay[counter].children[3].children[0].getAttribute("value");
            let desc = imgDisplay[counter].children[3].children[4].getAttribute("value");
            document.querySelector('.hh').innerHTML = `<h3 class="text margin">${title}</h3><p class="text">${desc}</p>`;
        })

    })

}

number(counter)