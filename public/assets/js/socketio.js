// const socket = io('http://127.0.0.1:3000');

// socket.on('connect', () => {
//     socket.sendBuffer = [];
//     console.log('Connected to socket');
// });

// socket.emit('dataFromClient',{
//     message: 'Hello from the client!',
//     timestamp: new Date().toISOString()
// });

// socket.on('dataFromServer', (data) => {
//     console.log(data);
// });

// socket.on('newRecognizedFace', (data) => {
//     //  console.log( data.responseData);

//     let faceData = data.responseData.data;

//     $('#face-background').empty();

//     $.each(faceData, function (key, val) {
//         let faceBackgroundDiv = `
//                                 <div class="col-12 m-1">
//                                     <div class="border position-relative border-4 ${val.group === 2 ? 'border-success' : (val.group === 5 ? 'border-danger' : 'border-warning')}" >
//                                         <div class="position-absolute face-image-div"  >
//                                                 <img class="face-images img-thumbnail w-100 " src="${val.face}" alt="Snapped Face ${key + 1}">
//                                         </div>
//                                         <img class="face-images img-thumbnail w-100 " src="${val.bg_url}" alt="Snapped Face ${key + 1}">
//                                         <div class="d-flex justify-content-around">
//                                             <div class="text-center">
//                                                 <div>
//                                                     ${val.phone != '' ? 'Phone : ' + val.phone : ''}
//                                                 </div>
//                                                 <div>
//                                                     ${val.name != '' ? ' Name :' +  val.name : ''}
//                                                 </div>
//                                                 <div>
//                                                     ${val.email != '' ? ' Email:' + val.email : ''}
//                                                 </div>
//                                                 <div>
//                                                     Time: ${(val.time)}
//                                                 </div>
//                                             </div>
//                                             <div style="" class="d-none">
//                                                 <button style="color:black;" class="btn downloadButton"><span><i class=" ri-download-cloud-2-line"></i></span></button>
//                                             </div>
//                                         </div>
//                                     </div>
//                                 </div>`;
//         let checkIdExist = document.getElementById('face-background');

//         if(checkIdExist){
//             checkIdExist.insertAdjacentHTML('afterbegin', faceBackgroundDiv);
//         }
//     });


// });



  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = false;

  var pusher = new Pusher('522a4ee8238bd93b8744', {
    cluster: 'ap2'
  });

  var channel = pusher.subscribe('face-recognize');
    channel.bind('face-notification', function(data) {
    //   console.log(data)
    //   $('#face-background').empty();

          $.each(data, function (key, val) {
              let faceBackgroundDiv = `
                                      <div class="col-12 m-1">
                                          <div class="border position-relative border-4 ${val.group === 2 ? 'border-success' : (val.group === 5 ? 'border-danger' : 'border-warning')}" >
                                              <div class="position-absolute face-image-div"  >
                                                      <img class="face-images img-thumbnail w-100 " src="${val.face}" alt="Snapped Face ${key + 1}">
                                              </div>
                                              <img class="face-images img-thumbnail w-100 " src="${val.bg_url}" alt="Snapped Face ${key + 1}">
                                              <div class="d-flex justify-content-around">
                                                  <div class="text-center">
                                                      <div>

                                                          ${val.name != '' ? ' Name :' +  val.name : ''}
                                                      </div>
                                                      <div>
                                                        ${val.phone != '' ? 'Phone : ' + val.phone : ''}
                                                      </div>
                                                      <div>
                                                          ${val.email != '' ? ' Email:' + val.email : ''}
                                                      </div>
                                                      <div>
                                                          Time: ${(val.time)}
                                                      </div>
                                                  </div>
                                                  <div style="" class="d-none">
                                                      <button style="color:black;" class="btn downloadButton"><span><i class=" ri-download-cloud-2-line"></i></span></button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>`;
              let checkIdExist = document.getElementById('face-background');

              if(checkIdExist){
                  checkIdExist.insertAdjacentHTML('afterbegin', faceBackgroundDiv);
                  const elements = document.querySelectorAll('#face-background .col-12');
                const count = elements.length;
                if(count > 4){
                  //elements[count - 1].remove();
                  $('#face-background').empty();
                }
              }
          });
    });



