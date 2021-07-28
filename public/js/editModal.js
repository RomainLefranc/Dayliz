const formEdit = document.querySelector("#formEdit");
const formEditTitle = document.querySelector("#formEditTitle");
const titleEdit = document.querySelector("#titleEdit");
const descriptionEdit = document.querySelector("#descriptionEdit");
const durationEdit = document.querySelector("#durationEdit");

const getData = (elem) => {
    console.log(titleEdit);
    let target = elem.dataset.id;
    window.axios
        .get(`/activities/${target}/show`)
        .then((res) => {
            console.log(res.data);
            formEdit.action = `/activities/${target}/update`;
            formEditTitle.innerHTML = `Modifier l'activité ${res.data.title}`;
            titleEdit.value = res.data.title;
            descriptionEdit.innerHTML = res.data.description;
            durationEdit.value = res.data.duree;
        })
        .catch((err) => console.log(err.message));
};
