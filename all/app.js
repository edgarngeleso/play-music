window.onload=function(){
		loadsongs();
	}
	function loadsongs(){
		let songsCont = document.querySelector("#songsCont");
		let songcredentials = document.querySelector("#songcredentials");
		let searched = document.querySelector("#searched");
		let xhr = new XMLHttpRequest();
		xhr.open("POST","all/data.php",true);
		xhr.onload=function(){
			if (this.status==200) {
				let number=1;
				let songs = []
				let songnames = []
				let datas = JSON.parse(this.responseText)
				console.log(this.responseText)
				for(let data in datas){
					songs.push(datas[data].songpath)
					songnames.push(datas[data].songname)
					let output="";
					output+=`
					<b>${number}.</b>
					<div id="songname">
					<span >${datas[data].songname}</span>
					</div>
					<button><a download="${datas[data].songname}" href="${datas[data].songpath}">download</a></button>
					`;
					number++;
					songcredentials.innerHTML+=output;
				}
			
				let play = document.querySelector("#play");
				let audio = document.querySelector("#audio");
				let barCont = document.querySelector("#barCont");
				let bar = document.querySelector("#bar");
				let next = document.querySelector("#next");
				let previous = document.querySelector("#previous");
				let place = document.querySelector("#place");
				let songsdisplay = document.querySelectorAll("#songcredentials #songname");
				let img = document.querySelector("#img");
				let elapsed = document.querySelector("#elapsed");
				let status = 0;
				let index = 0;
				let current = songs[index];
				place.innerHTML=songnames[index].replace(".mp3","")

//display songs
				songsdisplay.forEach(result=>{
				result.addEventListener('click',function(){
					 if (status==0) {
					 	play.innerHTML="&#9208";
						status=1;
					 }
					img.classList.add("rotate");
					this.style.color='green';
					audio.src =`all/allmusic/${this.textContent}`;
					place.innerHTML=this.textContent.replace(".mp3","")
					audio.play();
					})
				})

//next song
				next.addEventListener('click',()=>{
					index++;
					if (index>=songs.length-1) {
		 				index=0;
					 }
					 if (status==0) {
					 	play.innerHTML="&#9208";
						status=1;
					 }
					 img.classList.add("rotate");
					 audio.src=songs[index];
					 audio.play()
					 place.innerHTML=songnames[index].replace(".mp3","")
				})

//previous song
				previous.addEventListener('click',()=>{
					index--;
					 if (index<0) {
		 				index=songs.length-1;
		 			}
		 			if (status==0) {
					 	play.innerHTML="&#9208";
						status=1;
					 }
		 			status=1;
		 			img.classList.add("rotate");
					 audio.src=songs[index];
					 audio.play()
					 place.innerHTML=songnames[index].replace(".mp3","")
				})

//play song
				audio.src = current;
				play.addEventListener('click',function(current){
				place.innerHTML=songnames[index].replace(".mp3","")
					if (status==0) {
						audio.play()
						play.innerHTML="&#9208";
						status=1;
						img.classList.add("rotate");
					}else if(status==1){
						audio.pause();
						play.innerHTML="&#9205";
						status=0;
						img.classList.remove("rotate");
					}
		
				})

//update time of current song
				audio.addEventListener('timeupdate',function(e){
					e.preventDefault();
					let duration = e.target.duration;
					let time = e.target.currentTime;


				//progress set on click event
				barCont.addEventListener('click',(e)=>{
					let position = e.offsetX;
					//let awidth = this.getBoundingClientRect(); 
					let awidth = parseInt(getComputedStyle(this).width.replace("px","")); 
					//time+=(position/500)*duration;
					var updated = (position/awidth)*100;
					let calculatewidth = 0
					if (position>awidth) {
						console.log(position-awidth)
						calculatewidth+=(position-awidth);
						updated=(calculatewidth/position)*100;
					}

					time=(duration/(updated/100));
					console.log(time,position,awidth,updated);

					bar.style.width=`${updated}%`
					
				})
				
					let percent = (time/duration)*100;
					bar.style.width=`${percent}%`;
					bar.style.background="blue";
					let totalminutes = duration/60;
					let totalseconds = duration%60;
					let minutes=0;
					if (parseInt(time)%60==0 ) {
						minutes++; 
					}
					let id = setInterval(update,1000);
					let seconds = 0;
					function update(){
						seconds++;
						if (seconds>=60) {
							seconds=0;
							minutes++;
						}

					}
					elapsed.innerHTML=`${parseInt(time)}/${parseInt(totalminutes)}:${parseInt(totalseconds)}`
					


				})

//end event.play next song when current is finished
				audio.addEventListener('ended',()=>{
					index++;
					if(index>songs.length-1) {
						index=0;
						}
					place.innerHTML=songnames[index].replace(".mp3","")
					audio.src=songs[index];
					audio.play();
				})


				

			}else{
				songcredentials.innerHTML="Loading...";
			}
		}
		xhr.send();
	}


	//search songs
	let search = document.querySelector("#searchSong");
	search.addEventListener('input',function(e){
		e.preventDefault();
		let value = e.target.value;
		if(value=="" || value==null) {
			searched.innerHTML="";
			return false;
		}else{
		let request = new XMLHttpRequest();
		request.open("POST","all/searchSong.php",true);
		request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		let params = "value="+value;
		 request.onload=function(){
		 	if (this.status==200) {
		 		searched.innerHTML=this.responseText
		 	}
		 }
		request.send(params);
	}
	})