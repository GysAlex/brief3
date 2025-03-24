function openModal3() 
{
    document.getElementById('searchModal3').classList.add('showF')  
}

function closeModal3() 
{
    document.getElementById('searchModal3').classList.remove('showF')    
}

function openModal4() 
{
    document.getElementById('searchModal4').classList.add('showF')  
}

function closeModal4() 
{
    document.getElementById('searchModal4').classList.remove('showF')    
}


document.querySelector('.see').addEventListener('click', function(e){
    e.currentTarget.classList.add('d-none')
    e.currentTarget.previousElementSibling.classList.remove('d-none')
    e.currentTarget.parentElement.querySelector('input').type = "password"
})

document.querySelector('.hide').addEventListener('click', function(e){
    e.currentTarget.nextElementSibling.classList.remove('d-none')
    e.currentTarget.classList.add('d-none')
    e.currentTarget.parentElement.querySelector('input').type = "text"
})


document.querySelector('.see2').addEventListener('click', function(e){
    e.currentTarget.classList.add('d-none')
    e.currentTarget.previousElementSibling.classList.remove('d-none')
    e.currentTarget.parentElement.querySelector('input').type = "password"
})

document.querySelector('.hide2').addEventListener('click', function(e){
    e.currentTarget.nextElementSibling.classList.remove('d-none')
    e.currentTarget.classList.add('d-none')
    e.currentTarget.parentElement.querySelector('input').type = "text"
})
