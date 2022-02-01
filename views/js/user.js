$('.new_img').change(function(){
	let image = this.files[0];

	// validate image format
	if (image["type"] != "image/jpeg" && image["type"] != "image/png" && image["type"] != "image/jpg"){

		$(".new_img").val("");

		swal({
			type: "error",
			title: "Error uploading image",
			text: "Image type has to be JPEG, JPG or PNG!",
			showConfirmButton: true,
			confirmButtonText: "Close"
    });
    // check img size
}else if(image["size"] > 5000000){

		$(".new_img").val("");

		swal({
			type: "error",
			title: "Image size error",
			text: "Image size too big. It has to be less than 5Mb!",
			showConfirmButton: true,
			confirmButtonText: "Close"
		});
}else{
	let imgData = new FileReader;
		imgData.readAsDataURL(image);

		$(imgData).on("load", function(event){
			
			let imgRoute = event.target.result;

			$(".preview").attr("src", imgRoute);

		});
}

});
