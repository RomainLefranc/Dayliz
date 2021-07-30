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
            formEdit.action = `/examens/${id_examen}/activities/${id_activity}/update`;
            formEditTitle.innerHTML = `Modifier l'activité ${res.data.data.title}`;
            titleEdit.value = res.data.data.title;
            descriptionEdit.innerHTML = res.data.data.description;
            durationEdit.value = res.data.data.duree;
        })
        .catch((err) => console.log(err.message));
};
