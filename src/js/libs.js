fetch("../PHP/hienthi_ttgv.php")
    .then(res => res.text())
    .then(html => {
        document.getElementById("list-gv").innerHTML = html;
    })
    .catch(err => console.error("Lỗi: ", err));