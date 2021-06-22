const formEdit = document.querySelector('#formEdit')
const formEditTitle = document.querySelector('#formEditTitle')
const titleEdit = document.querySelector('#titleEdit')
const descriptionEdit = document.querySelector('#descriptionEdit')
const beginAtEdit = document.querySelector('#beginAtEdit')
const endAtEdit = document.querySelector('#endAtEdit')
const getData = (elem) => {
    console.log(titleEdit)
    let target = elem.dataset.id
    window.axios.get(`/activities/show/${target}`)
        .then((res) => {
            console.log(res.data)
            formEdit.action = `/activities/update/${target}`
            formEditTitle.innerHTML = `Modifier l'activité ${res.data.title}`
            titleEdit.value = res.data.title
            descriptionEdit.innerHTML = res.data.description
            beginAtEdit.value = res.data.beginAt.replace(' ', 'T')
            endAtEdit.value = res.data.endAt.replace(' ', 'T')
        })
        .catch((err) => console.log(err.message))
}