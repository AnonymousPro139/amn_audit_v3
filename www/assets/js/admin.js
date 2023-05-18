function confirmDelete() {
  if (confirm("Та устгахдаа итгэлтэй байна уу?")) {
    return true;
  } else {
    event.stopPropagation();
    event.preventDefault();
  }
}

function confirmShow() {
  if (confirm("Та мэдэгдлийг хүлээн авсандаа итгэлтэй байна уу?")) {
    return true;
  } else {
    event.stopPropagation();
    event.preventDefault();
  }
}

function confirmUpdate(){
  if (confirm("Та өөрчлөлт хийснээ хадгалахдаа итгэлтэй байна уу?")) {
    return true;
  } else {
    event.stopPropagation();
    event.preventDefault();
  }
}