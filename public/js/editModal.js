const formEdit = document.querySelector("#formEdit");
const formEditTitle = document.querySelector("#formEditTitle");
const titleEdit = document.querySelector("#titleEdit");
const descriptionEdit = document.querySelector("#descriptionEdit");
const durationEdit = document.querySelector("#durationEdit");

const getData = (elem) => {
    let id_activity = elem.dataset.id;
    let id_examen = elem.dataset.exam;
    window.axios
        .get(`/examens/${id_examen}/activities/${id_activity}/show`)
        .then((res) => {
            console.log(res.data)
            formEdit.action = `/examens/${id_examen}/activities/${id_activity}/update`;
            formEditTitle.innerHTML = `Modifier l'activité ${res.data.data.title}`;
            titleEdit.value = res.data.data.title;
            descriptionEdit.innerHTML = res.data.data.description;
            //durationEdit.value = res.data.data.duree;
            heures = Math.floor(res.data.data.duree / 3600) > 10 ? `${Math.floor(res.data.data.duree / 3600)}` : `0${Math.floor(res.data.data.duree / 3600)}`;
            minutes = Math.floor((res.data.data.duree / 60)%60) > 10 ? `${Math.floor((res.data.data.duree / 60)%60)}` : `0${Math.floor((res.data.data.duree / 60)%60)}`;
            durationEdit.value =  `${heures}:${minutes}`;
        })
        .catch((err) => console.log(err.message));
};
