const files = [
  "articles/art1.html",
  "articles/art2.html"
];

async function loadMeta(file) {
  const res = await fetch(file);
  const text = await res.text();

  const doc = new DOMParser().parseFromString(text, "text/html");

  return {
    title: doc.querySelector('meta[name="title"]')?.content || "senza titolo",
    date: doc.querySelector('meta[name="date"]')?.content || "",
    summary: doc.querySelector('meta[name="summary"]')?.content || "",
    file
  };
}

async function render() {
  const list = document.getElementById("lista");

  for (const f of files) {
    const data = await loadMeta(f);

    const div = document.createElement("div");
    div.innerHTML = `
      <h3><a href="${data.file}">${data.title}</a></h3>
      <small>${data.date}</small>
      <p>${data.summary}</p>
    `;

    list.appendChild(div);
  }
}

render();