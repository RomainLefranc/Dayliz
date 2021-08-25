const formEdit = document.querySelector("#formEdit");
const formEditTitle = document.querySelector("#formEditTitle");
const titleEdit = document.querySelector("#titleEdit");
const descriptionEdit = document.querySelector("#descriptionEdit");
const durationEdit = document.querySelector("#durationEdit");

const getData = (elem) => {
    let id_activity = elem.dataset.id;
    let id_examen = elem.dataset.exam;
    let users;
    window.axios
    .get(`/promotions/${id_examen}/examen`)
    .then((res)=>{
        users = res.data
        console.log(res)
    })
    .catch((err)=>{
        console.log(err)
    })
    window.axios
    .get(`/api/activities/${id_activity}`)
    .then((res) => {
        console.log(res.data)
        users.forEach(user => {
           res.data.data.user_id == user.id ?  userEdit.innerHTML += `<option value=${user.id} selected> ${user.firstName} ${user.lastName}</option>` :  userEdit.innerHTML += `<option value=${user.id}> ${user.firstName} ${user.lastName}</option>`
        })
        formEdit.action = `/examens/${id_examen}/activities/${id_activity}/update`;
        formEditTitle.innerHTML = `Modifier l'activité ${res.data.data.title}`;
        titleEdit.value = res.data.data.title;
        descriptionEdit.innerHTML = res.data.data.description;
        //durationEdit.value = res.data.data.duree;
        heures = Math.floor(res.data.data.duree / 3600) >= 10 ? `${Math.floor(res.data.data.duree / 3600)}` : `0${Math.floor(res.data.data.duree / 3600)}`;
        minutes = Math.floor((res.data.data.duree / 60)%60) >= 10 ? `${Math.floor((res.data.data.duree / 60)%60)}` : `0${Math.floor((res.data.data.duree / 60)%60)}`;
        durationEdit.value =  `${heures}:${minutes}`;
    })
    .catch((err) => console.log(err.message));
  
};
