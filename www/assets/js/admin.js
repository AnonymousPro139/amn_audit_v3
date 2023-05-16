function confirmDelete() {
  // return confirm("Та устгахдаа итгэлтэй байна уу");

  if (confirm("Та устгахдаа итгэлтэй байна уу?")) {
    return true;
  } else {
    event.stopPropagation();
    event.preventDefault();
  }
}

function confirmShow() {
  // return confirm("Та мэдэгдлийг хүлээн авсандаа итгэлтэй байна уу");

  if (confirm("Та мэдэгдлийг хүлээн авсандаа итгэлтэй байна уу?")) {
    return true;
  } else {
    event.stopPropagation();
    event.preventDefault();
  }
}
