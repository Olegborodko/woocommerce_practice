// pro popup with codes
function awr_show_in_pro () {
	return Swal.fire({
	    html: `
        <div class="awpr-popup-container"> 
			<div class="">
				<div class="bg-[#FF8E3E]/5 max-w-[300px] mx-auto text-center pt-5 pb-6 px-3 rounded-t rounded-b-xl relative">
					<h2 class="text-xl mb-1 text-[#0D0A14]">UPGRADE TO <span class="text-[#FF8E3E] font-bold">PRO</span></h2>
					<p class="text-xs text-[#0D0A14]">Unlock the full power of <span class="font-bold">Advanced WP Reset</span></p>
					<img src="` + awr_ajax_obj.images_path + `/arrow-shape.svg" alt="" class="absolute -bottom-8 -right-10 pointer-events-none w-10 inline-block">
				</div>
				<div class="text-center -mt-3 relative">
					<div class="bg-white border border-[#FF8E3E]/25 rounded-full inline-flex items-center justify-center gap-1.5 px-6 py-1">
						<div class="flex items-center gap-1 text-[#9C9C9C] font-bold text-xs">
							<span class="icon-star-full text-[#FF8E3E]"></span>
							<span class="">4.9</span>
						</div>
						<div class="w-[1px] h-4 bg-[#FF8E3E]/25"></div>
						<p class="text-[#FF8E3E] text-xs font-medium">Join our happy clients</p>
					</div>
				</div>
				<div class="grid grid-cols-1 md:grid-cols-2 gap-3 p-3 mt-2">
					<!-- Free -->
					<div class="border border-[#F5FBFF] bg-[#F5FBFF] rounded px-2 pb-2 pt-5 text-center relative overflow-hidden">
						<div class="mb-3">
							<h3 class="text-xl text-[#0D0A14] font-semibold mb-2">Free</h3>
							<p class="text-[10px] text-[#0D0A14]">For occasional users looking for basic reset capabilities</p>            
						</div>
						<div class="mb-3">
							<span class="text-2xl font-semibold text-[#0D0A14]">0$</span>
						</div>
						<div class="grid place-content-center mb-4">
							<ul class="text-[#0D0A14] !text-xs grid gap-1.5 !p-0">
								<li class="flex items-center gap-1 mb-0">
									<span class="w-4 h-4 rounded-full bg-[#F5FBFF] inline-flex items-center justify-center text-[#FF8E3E]">
										<span class="icon-check"></span>
									</span>
									<span>Basic features</span>
								</li>
								<li class="flex items-center gap-1 mb-0 text-[#9C9C9C]">
									<span class="w-4 h-4 rounded-full bg-[#F5FBFF] inline-flex items-center justify-center text-[10px]">
										<span class="icon-close"></span>
									</span>
									<span class="line-through">Pro features</span>
								</li>
								<li class="flex items-center gap-1 mb-0 text-[#9C9C9C]">
									<span class="w-4 h-4 rounded-full bg-[#F5FBFF] inline-flex items-center justify-center text-[10px]">
										<span class="icon-close"></span>
									</span>
									<span class="line-through">Premium support</span>
								</li>
								<li class="flex items-center gap-1 mb-0 text-[#9C9C9C]">
									<span class="w-4 h-4 rounded-full bg-[#F5FBFF] inline-flex items-center justify-center text-[10px]">
										<span class="icon-close"></span>
									</span>
									<span class="line-through">Features requests</span>
								</li>
								<li class="flex items-center gap-1 mb-0 text-[#9C9C9C]">
									<span class="w-4 h-4 rounded-full bg-[#F5FBFF] inline-flex items-center justify-center text-[10px]">
										<span class="icon-close"></span>
									</span>
									<span class="line-through">Beta features</span>
								</li>
							</ul>
						</div>
						<p class="text-xs font-semibold text-[#0D0A14]">Your current plan</p>
					</div>
					<!-- Pro -->
					<div class="border border-[#FF8E3E]/50 bg-white rounded px-2 pb-2 pt-5 text-center relative overflow-hidden">
						<div class="w-[70px] h-[70px] rounded-full bg-[#FF8E3E] text-white text-center absolute -top-3 -right-3 p-2 flex items-center">
							<div class="w-11/12 mt-1">
								<h4 class="text-base font-bold mb-0">-50%</h4>
								<p class="text-[10px] leading-none">Offer ends soon</p>
							</div>
						</div>
						<div class="mb-3">
							<h3 class="text-xl text-[#FF8E3E] font-semibold mb-2">
								<span class="bg-[#FF8E3E]/5 inline-block py-1.5 px-4 rounded-full leading-none">Pro</span>
							</h3>
							<p class="text-[10px] text-[#707070]">Turbocharge your WP Developement with Pro features & premium support</p>            
						</div>
						<div class="mb-3">
							<h5 class="text-xs font-semibold text-[#8B8294] mb-0">From</h5>
							<div class="inline-flex items-center gap-2">
								<span class="text-sm text-[#8B8294] line-through">$79</span>
								<span class="text-2xl font-semibold text-[#FF8E3E]">$39</span>
								<span class="text-sm text-[#8B8294]">/year</span>
							</div>
						</div>
						<div class="grid place-content-center mb-4">
							<ul class="text-[#0D0A14] !text-xs grid gap-1.5 !p-0">
								<li class="flex items-center gap-1 mb-0">
									<span class="w-4 h-4 rounded-full bg-[#F5FBFF] inline-flex items-center justify-center text-[#FF8E3E]">
										<span class="icon-check"></span>
									</span>
									<span>Basic features</span>
								</li>
								<li class="flex items-center gap-1 mb-0">
									<span class="w-4 h-4 rounded-full bg-[#F5FBFF] inline-flex items-center justify-center text-[#FF8E3E]">
										<span class="icon-check"></span>
									</span>
									<span>Pro features</span>
								</li>
								<li class="flex items-center gap-1 mb-0">
									<span class="w-4 h-4 rounded-full bg-[#F5FBFF] inline-flex items-center justify-center text-[#FF8E3E]">
										<span class="icon-check"></span>
									</span>
									<span>Premium support</span>
								</li>
								<li class="flex items-center gap-1 mb-0">
									<span class="w-4 h-4 rounded-full bg-[#F5FBFF] inline-flex items-center justify-center text-[#FF8E3E]">
										<span class="icon-check"></span>
									</span>
									<span>Features requests</span>
								</li>
								<li class="flex items-center gap-1 mb-0">
									<span class="w-4 h-4 rounded-full bg-[#F5FBFF] inline-flex items-center justify-center text-[#FF8E3E]">
										<span class="icon-check"></span>
									</span>
									<span>Beta features</span>
								</li>
							</ul>
						</div>
						
						<form action="` + awr_ajax_obj.awr_pro_url + `">
							<button class="w-full flex items-center justify-center text-center gap-1 bg-[#FF8E3E] text-white text-xs font-semibold py-2 px-3 transition hover:bg-orange-500">
								<span class="icon-unlock"></span>
								<span>Upgrade to PRO</span>
							</button>
						</form>
					</div>
				</div>
			</div>
        </div>
        `,
		width: '400px',
		showCloseButton: true,
		showCancelButton: false,
		showConfirmButton: false,
		cancelButtonText: "Cancel",
		customClass: {
			cancelButton: "awpr-popup-btn awpr-popup-btn-light cancel-button-error",
		},
		buttonsStyling: false,
	});
}
function awr_show_error(error_description) {
	return Swal.fire({
	    html: `
        <div class="awpr-popup-container awpr-popup-confirmation"> 
            <h2 class="flex items-center gap-2 font-semibold px-5 py-3 text-xl text-awpr-dark-gray">
                <span class="icon-info"></span>
                <span>Error</span>
            </h2>
            <hr class="border-b-0 border-t border-[#CBBDD4]">
            <div class="text-left p-5">
                <p class="p-modal text-base mb-2">` + error_description + `</p>
            </div>
        </div>
        `,
		showCloseButton: true,
		showCancelButton: true,
		showConfirmButton: false,
		cancelButtonText: "Cancel",
		customClass: {
			cancelButton: "awpr-popup-btn awpr-popup-btn-light cancel-button-error",
		},
		buttonsStyling: false,
	});
}
function awr_show_confimation(params) {

	let custom_message = params.hasOwnProperty("message") ? params["message"] : "";
	let custom_image = params.hasOwnProperty("image") ? params["image"] : "alert_delete.svg";
	let ok_text = params.hasOwnProperty("ok_text") ? params["ok_text"] : "Continue";

	return Swal.fire({
		html: `
        <div class="awpr-popup-container awpr-popup-confirmation"> 
            <h2 class="flex items-center gap-2 font-semibold px-5 py-3 text-xl text-awpr-danger-dark">
                <span class="icon-info"></span>
                <span>Be careful</span>
            </h2>
            <hr class="border-b-0 border-t border-[#CBBDD4]">
            <div class="text-left p-5">
                <p class="p-modal text-base mb-2">` + custom_message + `</p>
                <p class="p-modal-careful text-base font-bold text-awpr-danger">` + awr_ajax_obj.irreversible_msg + `</p>
            </div>
        </div>
        `,
		showCloseButton: true,
		showCancelButton: true,
		showConfirmButton: true,
		confirmButtonText: ok_text,
		cancelButtonText: "Cancel",
		customClass: {
			confirmButton: "awpr-popup-btn awpr-popup-btn-danger confirm-button-careful",
			cancelButton: "awpr-popup-btn awpr-popup-btn-light cancel-button-careful",
		},
		buttonsStyling: false,
	});
}
function awr_show_processing_msg_box( message = awr_ajax_obj.processing ) {

	return Swal.fire({		
		html: `
        <div class="awpr-popup-container"> 
            <h2 class="flex items-center gap-2 font-semibold px-5 py-3 text-xl text-awpr-brand">
                <span class="icon-hour-glass"></span>
                <span>Processing...</span>
            </h2>
            <hr class="border-b-0 border-t border-[#CBBDD4]">
            <div class="text-left p-5">
                <p class="p-modal text-base mb-2">` + message + `</p>
                <div class="text-center">
					<span class="icon-sync-wrapper">
						<span class="icon-sync text-awpr-brand text-6xl animate-spin-reverse"></span>
					</span>

                </div>
            </div>
        </div>
        `,
		showCloseButton: true,
		showCancelButton: false,
		showConfirmButton: false,
	});
}
function awr_show_success( message = awr_ajax_obj.done ) {

	return Swal.fire({
		html: `
        <div class="awpr-popup-container"> 
            <h2 class="flex items-center gap-2 font-semibold px-5 py-3 text-xl text-awpr-success">
                <span class="icon-check"></span>
                <span>Done</span>
            </h2>
            <hr class="border-b-0 border-t border-[#CBBDD4]">
            <div class="text-left p-5">
                <p class="p-modal text-base mb-2">` + message + `</p>
                <div class="text-center">
                    <span class="icon-check-circle text-6xl text-awpr-success"></span>
                </div>
            </div>
        </div>
        `,
		showCloseButton: true,
		showCancelButton: false,
		showConfirmButton: false,
		timer: 3000
	});
}
function awr_show_input() {

	return Swal.fire({
		html: `
        <div class="awpr-popup-container"> 
            <h2 class="flex items-center gap-2 font-semibold px-5 py-3 text-xl text-awpr-brand">
                <span class="icon-check"></span>
                <span>Confirmation</span>
            </h2>
            <hr class="border-b-0 border-t border-[#CBBDD4]">
            <div class="text-left p-5">
                <p class="p-modal text-base mb-2">You are about to save a user custom reset.</p>
                <div class="flex items-center gap-2">
                    <label for="awr-input-id" class="text-base">Name:</label>
                    <input id="awr-input-id" placeholder="Name" class="swal2-input text-base border border-awpr-light-gray bg-awpr-light-gray px-4 py-2 m-0 shadow-none">
                </div>
                <p id="error-message" class="error-message text-base text-awpr-danger-dark"></p>
            </div>
        </div>
        `,
		showCloseButton: true,
		showCancelButton: true,
		showConfirmButton: true,
		customClass: {
			confirmButton: "awpr-popup-btn awpr-popup-btn-brand",
			cancelButton: "awpr-popup-btn awpr-popup-btn-light",
		},
		buttonsStyling: false,
		preConfirm: () => {
			const inputValue = document.querySelector("#awr-input-id").value;
			if (!inputValue) {
				const errorMessage = document.querySelector("#error-message");
				errorMessage.textContent = "Please enter the name";
				return false;
			}
			return inputValue;
		},
	});
}
function awr_show_system_infos ( html) {

	return Swal.fire({
		html: `<div class="awpr-popup-container"> 
            <h2 class="flex items-center gap-2 font-semibold px-5 py-3 text-xl text-awpr-success">
                <span class="icon-check"></span>
                <span>System infos</span>
            </h2>
            <hr class="border-b-0 border-t border-[#CBBDD4]">
            <div class="p-5 text-left max-h-[calc(100vh-300px)] overflow-y-auto" id="awr-system-infos-content">` + html + `</div>
        </div>`,
		width: '500px',
		showCloseButton: true,
		showCancelButton: true,
		showConfirmButton: false,

		confirmButtonText: "Copy to Clipboard",
		cancelButtonText: "Cancel",

		customClass: {
			confirmButton: "awpr-popup-btn awpr-popup-btn-danger confirm-button-careful",
			cancelButton: "awpr-popup-btn awpr-popup-btn-light cancel-button-careful",
		},
		buttonsStyling: false,
	});
}
function awr_show_comparison_hardcoded( tables_in_current_only, tables_in_snapshot_only, identical, differences ) {

	return Swal.fire({
		html: `
		<div class="awpr-popup-container font-awpr-base"> 
            <h2 class="flex items-center gap-2 font-semibold px-5 py-3 text-xl text-awpr-success">
                <span class="icon-check"></span>
                <span>Snapshot comparison</span>
            </h2>
            <hr class="border-b-0 border-t border-[#CBBDD4]">

			<div class="space-y-3 p-5 text-left max-h-[calc(100vh-300px)] overflow-y-auto">
				<!-- Tables in only one database -->
				<div class="table_in_only_one_db">
					<div class="flex justify-between items-center px-5 py-3 text-awpr-gray bg-[#F8F4FB] text-[15px]">
						Tables in only one database
						<div class="awpr-cc-toggle-icon" data-target="awr-table-one-db-content"></div>
					</div>

					<div id="awr-table-one-db-content" style="display:none;" class="list-rows bg-[#F8F4FB]">
						<div class="p-5">
							<table class="w-full table-fixed text-sm">
								<thead>
									<tr>
										<th class="text-left text-sm font-bold text-white bg-awpr-brand p-4 border-r border-white/30">Current</th>
										<th class="text-left text-sm font-bold text-white bg-awpr-brand p-4">Snapshot</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="bg-white p-4 border-r border-awpr-gray/30">
											` + tables_in_current_only + `
										</td>
										<td class="bg-white p-4">
											` + tables_in_snapshot_only + `
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<!-- Tables in both databases -->
				<div class="table_in_both_db">
					<div class="flex justify-between items-center px-5 py-3 text-awpr-gray bg-[#F8F4FB] text-[15px]">
						Tables in both databases
						<div class="awpr-cc-toggle-icon" data-target="awr-table-both-db-content"></div>
					</div>

					<div id="awr-table-both-db-content" style="display:none;" class="list-rows bg-[#F8F4FB]">
						<div class="p-5 space-y-5">
							<!-- Differents -->
							<div class="bg-white p-5 space-y-4">
								<div class="flex gap-2 items-center mb-2">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 26 25" class="w-6 h-6">
										<path fill="#DC3154" d="M11.51 7.496c4.652 0 9.66-1.008 9.66-3.22s-5.008-3.262-9.66-3.262-9.659 1.05-9.659 3.262c0 2.212 5.007 3.22 9.66 3.22Z"/>
										<path fill="#DC3154" d="M11.51 8.784c-2.663 0-7.597-.43-9.633-2.125-.013 0-.013-.013-.026-.013 0 2.596 5.07 3.19 7.727 3.361v1.288c-2.318-.142-5.846-.605-7.727-2.048v.18c0 2.55 6.324 3.22 9.66 3.22 3.335 0 9.658-.67 9.658-3.22v-2.78c-2.423 1.732-6.699 2.138-9.659 2.138Zm.644 2.575h-1.288v-1.288h1.288v1.288Z"/>
										<path fill="#DC3154" d="M11.51 13.935c-2.655 0-7.623-.438-9.633-2.112-.013 0-.013-.013-.026-.013 0 2.58 5.114 3.18 7.727 3.348v1.288c-2.318-.141-5.846-.605-7.727-2.047 0 2.923 6.83 3.4 9.66 3.4 3.335 0 9.658-.67 9.658-3.22V11.81c-2.412 1.722-6.76 2.125-9.659 2.125Zm.644 2.576h-1.288v-1.288h1.288v1.288Z"/>
										<path fill="#DC3154" d="M1.877 16.974c-.013 0-.013-.013-.026-.013 0 2.58 5.114 3.18 7.727 3.349v1.288c-2.318-.142-5.846-.606-7.727-2.048 0 2.927 6.759 3.443 9.66 3.443 4.648 0 9.658-1.048 9.658-3.263v-2.769c-2.576 1.997-8.255 2.125-9.659 2.125-1.403 0-7.044-.128-9.633-2.112Zm10.277 4.688h-1.288v-1.288h1.288v1.288Z"/>
										<circle cx="18.879" cy="18.379" r="5.21" fill="#DC3154" stroke="#FCFCFC" stroke-width=".338"/>
										<path fill="#fff" d="M19.18 18.084 21.265 16l.595.596-2.084 2.084 2.084 2.085-.595.595-2.085-2.084-2.084 2.084-.596-.595 2.084-2.085-2.084-2.084.596-.596 2.084 2.084Z"/>
									</svg>
									<h6 class="font-bold text-base text-awpr-danger">Different tables</h6>
								</div>
								` + differences + `
							</div>
							<!-- Identical -->
							<div class="bg-[#37AE53]/10 p-5">
								<div class="flex gap-2 items-center mb-2">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 26 25" class="w-6 h-6">
										<path fill="#37AE53" d="M11.51 7.496c4.652 0 9.66-1.008 9.66-3.22s-5.008-3.262-9.66-3.262-9.659 1.05-9.659 3.262c0 2.212 5.007 3.22 9.66 3.22Z"/>
										<path fill="#37AE53" d="M11.51 8.784c-2.663 0-7.597-.43-9.633-2.125-.013 0-.013-.013-.026-.013 0 2.596 5.07 3.19 7.727 3.361v1.288c-2.318-.142-5.846-.605-7.727-2.048v.18c0 2.55 6.324 3.22 9.66 3.22 3.335 0 9.658-.67 9.658-3.22V6.646c-2.423 1.732-6.699 2.138-9.659 2.138Zm.644 2.575h-1.288v-1.288h1.288v1.288Z"/>
										<path fill="#37AE53" d="M11.51 13.935c-2.655 0-7.623-.438-9.633-2.112-.013 0-.013-.013-.026-.013 0 2.58 5.114 3.18 7.727 3.348v1.288c-2.318-.142-5.846-.605-7.727-2.048 0 2.924 6.83 3.4 9.66 3.4 3.335 0 9.658-.67 9.658-3.22V11.81c-2.412 1.722-6.76 2.125-9.659 2.125Zm.644 2.576h-1.288v-1.288h1.288v1.288Z"/>
										<path fill="#37AE53" d="M1.877 16.974c-.013 0-.013-.013-.026-.013 0 2.58 5.114 3.18 7.727 3.349v1.288c-2.318-.142-5.846-.606-7.727-2.048 0 2.927 6.759 3.443 9.66 3.443 4.648 0 9.658-1.048 9.658-3.263v-2.769c-2.576 1.997-8.255 2.125-9.659 2.125-1.403 0-7.044-.128-9.633-2.112Zm10.277 4.688h-1.288v-1.288h1.288v1.288Z"/>
										<circle cx="18.864" cy="18.919" r="5.21" fill="#37AE53" stroke="#FCFCFC" stroke-width=".338"/>
										<path fill="#fff" fill-rule="evenodd" d="m22.08 17.021-4.074 4.075-2.216-2.215.407-.408 1.809 1.808 3.667-3.667.408.407Z" clip-rule="evenodd"/>
									</svg>
									<h6 class="font-bold text-base text-awpr-success">Identical tables</h6>
								</div>
								<div class="">
									<ol class="list-decimal space-y-2 pl-5 text-sm">
										` + identical + `										
									</ol>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>

        </div>
		`,
		width: '800px',
		showCloseButton: true,
		showCancelButton: true,
		showConfirmButton: false,

		confirmButtonText: "Open in new tab",
		cancelButtonText: "Cancel",

		customClass: {
			confirmButton: "awpr-popup-btn awpr-popup-btn-danger confirm-button-careful",
			cancelButton: "awpr-popup-btn awpr-popup-btn-light cancel-button-careful",
		},
		buttonsStyling: false,
	});
}
function awr_close_msg_box() {
	Swal.close();
}
