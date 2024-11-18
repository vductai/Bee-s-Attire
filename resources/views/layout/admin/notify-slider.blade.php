<div class="cr-bar-title">
    <h6>Thông báo<span class="label">12</span></h6>
    <a href="javascript:void(0)" class="close-notify"><i class="ri-close-line"></i></a>
</div>
<div class="cr-bar-content">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="alert-tab" data-bs-toggle="tab" data-bs-target="#alert"
                    type="button" role="tab" aria-controls="alert" aria-selected="true">Đơn hàng
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages"
                    type="button" role="tab" aria-controls="messages" aria-selected="false">Messages
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="log-tab" data-bs-toggle="tab" data-bs-target="#log" type="button"
                    role="tab" aria-controls="log" aria-selected="false">Log
            </button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="alert" role="tabpanel" aria-labelledby="alert-tab">
            <div class="cr-alert-list">
                <ul>
                    <div id="noti-manager-view">

                    </div>
                    @foreach($notis as $item)
                        <li>
                            <div class="icon cr-alert">
                                <i class="ri-alarm-warning-line"></i>
                            </div>
                            <div class="detail">
                                <div class="d-flex justify-content-start align-items-center">
                                    <p class="time mx-3">{{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</p>
                                    <span class="badge text-bg-danger">Mới</span>
                                </div>
                                <p class="message">{{$item->message}}</p>
                            </div>
                        </li>
                    @endforeach
                    <li class="check"><a class="cr-primary-btn" href="chatapp.html">View all</a></li>
                </ul>
            </div>
        </div>
        <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
            <div class="cr-message-list">
                <ul>
                    <li>
                        <a href="chatapp.html" class="reply">Reply</a>
                        <div class="user">
                            <img src="{{asset('assets/admin/img/user/9.jpg')}}" alt="user">
                            <span class="label online"></span>
                        </div>
                        <div class="detail">
                            <a href="chatapp.html" class="name">Boris Whisli</a>
                            <p class="time">5:30AM, Today</p>
                            <p class="message">Hello, I am sending some file. Please use this in landing
                                page. And make sure this all files are comppress.</p>
                            <span class="download-files">
											<span class="download">
												<img src="{{asset('assets/admin/img/other/1.jpg')}}" alt="image">
												<a href="javascript:void(0)"><i class="ri-download-2-line"></i></a>
											</span>
											<span class="download">
												<img src="{{asset('assets/admin/img/other/2.jpg')}}" alt="image">
												<a href="javascript:void(0)"><i class="ri-download-2-line"></i></a>
											</span>
											<span class="download">
												<span class="file">
													<i class="ri-file-ppt-line"></i>
												</span>
												<a href="javascript:void(0)"><i class="ri-download-2-line"></i></a>
											</span>
										</span>
                        </div>
                    </li>
                    <li>
                        <a href="chatapp.html" class="reply">Reply</a>
                        <div class="user">
                            <img src="{{asset('assets/admin/img/user/8.jpg')}}" alt="user">
                            <span class="label offline"></span>
                        </div>
                        <div class="detail">
                            <a href="chatapp.html" class="name">Frank N. Stein</a>
                            <p class="time">8:30PM, 05/12/2023</p>
                            <p class="message">Please take a look on landing page. There is some bus to open
                                popup model. and save form data.</p>
                        </div>
                    </li>
                    <li>
                        <a href="chatapp.html" class="reply">Reply</a>
                        <div class="user">
                            <img src="{{asset('assets/admin/img/user/7.jpg')}}" alt="user">
                            <span class="label busy"></span>
                        </div>
                        <div class="detail">
                            <a href="chatapp.html" class="name">Frank N. Stein</a>
                            <p class="time">8:30PM, 05/12/2023</p>
                            <p class="message">Please take a look on landing page. There is some bus to open
                                popup model. and save form data.</p>
                            <span class="download-files">
											<span class="download">
												<span class="file">
													<i class="ri-file-zip-line"></i>
												</span>
												<a href="javascript:void(0)"><i class="ri-download-2-line"></i></a>
											</span>
											<span class="download">
												<span class="file">
													<i class="ri-file-text-line"></i>
												</span>
												<a href="javascript:void(0)"><i class="ri-download-2-line"></i></a>
											</span>
											<span class="download">
												<span class="file">
													<i class="ri-file-ppt-line"></i>
												</span>
												<a href="javascript:void(0)"><i class="ri-download-2-line"></i></a>
											</span>
										</span>
                        </div>
                    </li>
                    <li>
                        <a href="chatapp.html" class="reply">Reply</a>
                        <div class="user">
                            <img src="{{asset('assets/admin/img/user/6.jpg')}}" alt="user">
                            <span class="label busy"></span>
                        </div>
                        <div class="detail">
                            <a href="chatapp.html" class="name">Paige Turner</a>
                            <p class="time">4:30PM, 12/12/2023</p>
                            <p class="message">Landing page issues are done. and now i am working on admin
                                user module.</p>
                        </div>
                    </li>
                    <li>
                        <a href="chatapp.html" class="reply">Reply</a>
                        <div class="user">
                            <img src="{{asset('assets/admin/img/user/5.jpg')}}" alt="user">
                            <span class="label busy"></span>
                        </div>
                        <div class="detail">
                            <a href="chatapp.html" class="name">Allie Grater</a>
                            <p class="time">8:30PM, 05/12/2023</p>
                            <p class="message">Take marketing module task.</p>
                        </div>
                    </li>
                    <li class="check"><a class="cr-primary-btn" href="chatapp.html">View all</a></li>
                </ul>
            </div>
        </div>
        <div class="tab-pane fade" id="log" role="tabpanel" aria-labelledby="log-tab">
            <div class="cr-activity-list activity-list">
                <ul>
                    <li>
									<span class="date-time">8 Thu<span class="time">11:30 AM - 05:10 PM
										</span></span>
                        <p class="title">Project Submitted from Smith</p>
                        <p class="detail">Lorem Ipsum is simply dummy text of the printing and
                            lorem is typesetting industry.</p>
                        <span class="download-files">
										<span class="download">
											<img src="{{asset('assets/admin/img/other/1.jpg')}}" alt="image">
											<a href="javascript:void(0)"><i class="ri-download-2-line"></i></a>
										</span>
										<span class="download">
											<img src="{{asset('assets/admin/img/other/2.jpg')}}" alt="image">
											<a href="javascript:void(0)"><i class="ri-download-2-line"></i></a>
										</span>
										<span class="download">
											<span class="file">
												<i class="ri-file-ppt-line"></i>
											</span>
											<a href="javascript:void(0)"><i class="ri-download-2-line"></i></a>
										</span>
									</span>
                    </li>
                    <li>
									<span class="date-time warn">7 Wed<span class="time">1:30 PM - 02:30 PM
										</span></span>
                        <p class="title">Morgus pvt - project due</p>
                        <p class="detail">Project modul delay for some bugs.</p>
                        <span class="download-files">
										<span class="download">
											<span class="file">
												<i class="ri-file-zip-line"></i>
											</span>
											<a href="javascript:void(0)"><i class="ri-download-2-line"></i></a>
										</span>
										<span class="download">
											<span class="file">
												<i class="ri-file-text-line"></i>
											</span>
											<a href="javascript:void(0)"><i class="ri-download-2-line"></i></a>
										</span>
										<span class="download">
											<img src="{{asset('assets/admin/img/other/3.jpg')}}" alt="image">
											<a href="javascript:void(0)"><i class="ri-download-2-line"></i></a>
										</span>
									</span>
                    </li>
                    <li>
									<span class="date-time">6 Tue<span class="time">9:30 AM - 11:00 AM
										</span></span>
                        <p class="title">Interview for management dept.</p>
                        <p class="detail">There are many variations of passages of Lorem Ipsum
                            available, but the majority have suffered alteration in some form,
                            by injected humour.</p>
                        <span class="download-files">
										<span class="download">
											<span class="file">
												<i class="ri-file-zip-line"></i>
											</span>
											<a href="javascript:void(0)"><i class="ri-download-2-line"></i></a>
										</span>
										<span class="download">
											<span class="file">
												<i class="ri-file-text-line"></i>
											</span>
											<a href="javascript:void(0)"><i class="ri-download-2-line"></i></a>
										</span>
										<span class="download">
											<span class="file">
												<i class="ri-file-ppt-line"></i>
											</span>
											<a href="javascript:void(0)"><i class="ri-download-2-line"></i></a>
										</span>
									</span>
                    </li>
                    <li>
									<span class="date-time">5 Mon<span class="time">3:30 AM - 4:00 PM
										</span></span>
                        <p class="title">Meeting with mr. Ken doe</p>
                        <p class="detail">The majority have suffered alteration in some form,
                            by injected humour.</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
