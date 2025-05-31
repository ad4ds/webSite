const scriptURL = 'https://script.google.com/macros/s/AKfycbwWLdb1FEx8kYimTvYTr_d75HhmC7iE7P0Vve_cyqtuaW-zvJ4s3m2Y0FzPJMX27HCV/exec'

const form = document.forms['contact-form']

form.addEventListener('submit', e => {
  
  e.preventDefault()
  
  fetch(scriptURL, { method: 'POST', body: new FormData(form)})
  .then(response => alert("Thank you! Form is submitted" ))
  .then(() => { window.location.reload(); })
  .catch(error => console.error('Error!', error.message))
})