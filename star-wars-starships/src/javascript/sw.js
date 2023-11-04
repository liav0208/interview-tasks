window.addEventListener("load", async () => {
  const prevBtn = document.getElementById("btn-prev");
  const nextBtn = document.getElementById("btn-next");
  const mainBtn = document.getElementById("main-btn");
  const popup = document.getElementById("sw-popup");
  const swLoader = document.getElementById("sw-loader");
  const swTable = document.getElementById("sw-table");
  const buttons = document.getElementById("sw-buttons");
  const close = document.getElementById("close");

  let data = await getData();

  mainBtn.style.display = "block";

  updateTable(data, nextBtn, prevBtn);

  nextBtn.addEventListener("click", async () => {
    swTable.style.display = "none";
    swLoader.style.display = "block";
    buttons.style.display = "none";
    data = await getData(data.next);
    updateTable(data, nextBtn, prevBtn);
    swTable.style.display = "table";
    swLoader.style.display = "none";
    buttons.style.display = "block";
  });

  prevBtn.addEventListener("click", async () => {
    swTable.style.display = "none";
    swLoader.style.display = "block";
    buttons.style.display = "none";
    data = await getData(data.previous);
    updateTable(data, nextBtn, prevBtn);
    swTable.style.display = "table";
    swLoader.style.display = "none";
    buttons.style.display = "block";
  });

  mainBtn.addEventListener("click", () => {
    popup.style.display = "block";
  });

  close.addEventListener("click", () => {
    popup.style.display = "none";
  });
});

const getData = async (url = null) => {
  const res = await fetch(url ?? "https://swapi.dev/api/starships/");
  const data = await res.json();
  return data;
};

const updateTable = (data, nextBtn, prevBtn) => {
  const tbody = document.getElementById("table-body");

  let html = "";

  data.results.forEach(
    (starship) =>
      (html += `
    <tr>
      <td>${starship.name}</td>
      <td>${starship.starship_class}</td>
      <td>${starship.crew}</td>
      <td>${starship.cost_in_credits}</td>
    </tr>
  `)
  );

  if (!data.previous) {
    prevBtn.style.visibility = "hidden";
  } else if (prevBtn.style.visibility == "hidden") {
    prevBtn.style.visibility = "visible";
  }

  if (!data.next) {
    nextBtn.style.visibility = "hidden";
  } else if (nextBtn.style.visibility == "hidden") {
    nextBtn.style.visibility = "visible";
  }

  tbody.innerHTML = html;
};
