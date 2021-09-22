const formEdit = document.querySelector("#formEdit");
const formEditTitle = document.querySelector("#formEditTitle");
const titleEdit = document.querySelector("#titleEdit");
const descriptionEdit = document.querySelector("#descriptionEdit");
const durationEdit = document.querySelector("#durationEdit");
const userEdit = document.querySelector("#userEdit");
const getData = (elem) => {
    let id_activity = elem.dataset.id;
    let id_examen = elem.dataset.exam;
    let users;
    window.axios
        .get(`/api/examens/${id_examen}/users`)
        .then((res) => {
            users = res.data.data;
            console.log(res.data.data);
        })
        .catch((err) => {
            console.log(err);
        });
    window.axios
        .get(`/api/activities/${id_activity}`)
        .then((res) => {
            let activity = res.data.data;
            console.log(activity);
            users.forEach((user) => {
                userEdit.innerHTML += `<option value=${user.id} ${
                    activity.user_id == user.id ? "selected" : ""
                }> ${user.firstName} ${user.lastName}</option>`;
            });
            formEdit.action = `/examens/${id_examen}/activities/${id_activity}/update`;
            formEditTitle.innerHTML = `Modifier l'activité ${activity.title}`;
            titleEdit.value = activity.title;
            descriptionEdit.innerHTML = activity.description;
            //durationEdit.value = activity.duree;
            heures =
                Math.floor(activity.duree / 3600) >= 10
                    ? `${Math.floor(activity.duree / 3600)}`
                    : `0${Math.floor(activity.duree / 3600)}`;
            minutes =
                Math.floor((activity.duree / 60) % 60) >= 10
                    ? `${Math.floor((activity.duree / 60) % 60)}`
                    : `0${Math.floor((activity.duree / 60) % 60)}`;
            durationEdit.value = `${heures}:${minutes}`;
        })
        .catch((err) => console.log(err.message));
};
