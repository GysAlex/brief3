function openModal2() 
{
    document.getElementById('searchModal2').classList.add('showF')  
}

function closeModal2() 
{
    document.getElementById('searchModal2').classList.remove('showF')    
}


async function sendData(url, data) {
    try {
        const request = await fetch(url, {
        method: 'POST',
        body: data
        });
    
        const result = await request.json();
        let f = document.getElementById('tryfetch');
        f.querySelector('input[type=hidden]').value = result.id
        f.querySelector('input[type=text]').value = result.username
        f.querySelector('input[type=email]').value = result.email
        f.querySelector('input[type=password]').value = "password"
        f.querySelectorAll('#status option').forEach(function(el){
            el.removeAttribute('selected')
            if(el.value == result.status)
            {
                el.setAttribute("selected", '')
            }
        })
        f.querySelectorAll('#role option').forEach(function(el){
            el.removeAttribute('selected')

            if(el.value == result.role_id)
            {
                el.setAttribute("selected", '')
            }
        })
    } catch (error) {
        console.error(error);
    }
}


async function history(url, data)
{
    try {
        const request = await fetch(url, {
        method: 'POST',
        body: data
        });
    
        const result = await request.json();
        console.log(result)

    } catch (error) {
        console.error(error);
    }
}



document.querySelectorAll(".item .lastlogin form").forEach((el)=>{
    el.addEventListener('submit', (e)=>{
    e.preventDefault()
    form = new FormData(el)

    value = el.querySelector('input').value

    form.append("id", value )

    history('http://localhost:8000/admin/sessions')
    
    })
 })






document.querySelectorAll(".action .edit form").forEach((el)=>{
   el.addEventListener('submit', (e)=>{
    e.preventDefault()
        form = new FormData(el)
        form.append("id", el.querySelector('input').value)

        sendData('http://localhost:8000/admin/userdata', form)
   });
})


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


names = Array.from(document.querySelectorAll(".tableUser .item .text")).map(function(el){
    return el.textContent.trim();
})


let elements = document.querySelectorAll('.tableUser .item')


function filteringFeature()
{
    let arr=[]
    document.querySelector('input[type=search]').addEventListener('input', function(e){
        if (e.target.value.trim().length > 0) 
        {
            newArr = Array.from(elements).filter(function(val){
                str = e.target.value.trim().toLocaleLowerCase()
                return !val.querySelector('.text').textContent.toLocaleLowerCase().includes(str)
            })

            gooArr = Array.from(elements).filter(function(val){
                str = e.target.value.trim().toLocaleLowerCase()
                return val.querySelector('.text').textContent.toLocaleLowerCase().includes(str)
            })

            newArr.forEach(function(el){
                el.classList.add('d-none')
            })

            gooArr.forEach(function(el){
                el.classList.remove('d-none')
            })
        }
        else
        {
            newArr = elements;
            newArr.forEach(function(el){
                el.classList.remove('d-none')
            })
        }
    })
}

filteringFeature()
