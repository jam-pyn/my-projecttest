<div>
    <table id="table-dishes" class="w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <div class="flex justify-left">
                        {{ __('ID') }}
                    </div>

                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <div class="flex justify-left">
                        {{ __('Dish Name') }}
                    </div>

                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <div class="flex justify-center">
                        {{ __('Price') }}
                    </div>
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <div class="flex justify-center">
                        {{ __('Category') }}
                    </div>
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <div class="flex justify-center">
                        {{ __('Actions') }}
                    </div>
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        </tbody>
    </table>

    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="modal-view" aria-labelledby="modal-view-title"
        role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500 opacity-75" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-view-title">
                                ข้อมูลผู้ใช้
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    กรอกข้อมูลผู้ใช้
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:py-4">
                    <form>
                        <div class="grid gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="dish_name" class="block text-sm font-medium text-gray-700">Dish name</label>
                                <input type="text" name="dish_name" id="dish_name"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="price" class="block text-sm font-medium text-gray-700">ราคา</label>
                                <input type="price" name="price" id="price"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                            </div>

                            {{-- <div class="col-span-6 sm:col-span-4">
                                <label for="category" class="block text-sm font-medium text-gray-700">สิทธิ์</label>
                                <select name="category" id="category"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    disabled>
                                    @foreach ($categorys as $category)
                                        <option value="{{ $category->category_id }}">{{ $category->category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                    </form>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:py-4">
                    <div class="flex flex-row-reverse">
                        <button type="button"
                            class="btn-sm-update mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                            อัพเดทข้อมูล
                        </button>
                        <button type="button"
                            class="model-close mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                            ปิด
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@script
    <script>
        $(document).ready(function() {
            console.log("hello");

            // กำหนด DataTable ให้กับ element `#table-users`
            var list_table = $('#table-dishes').DataTable({
                // กำหนดจำนวน record ที่แสดงต่อหน้าจอ เริ่มต้นที่ 5 record
                pageLength: 5,
                // กำหนดให้ datatable ตอบสนองต่อหน้าจอที่มีขนาดต่างกัน
                responsive: true,
                // แสดง indicator แถบแสดงสถานะการโหลดข้อมูล
                processing: true,
                // เปิดใช้งานการประมวลผลข้อมูลฝั่ง server
                serverSide: true,
                // กำหนด method การส่งข้อมูลไปยัง server
                serverMethod: 'post',
                // กำหนด URL สำหรับดึงข้อมูล
                ajax: {
                    url: '{{ route('dish.with.datatable') }}',

                    // กำหนด method การส่งข้อมูล
                    type: "post",

                    // กำหนด header เพิ่มเติม
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization',
                            'Bearer Vd74sxFrv98UJtR3cVlDvd2anjWMDzs12KmYIfbF23148588');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("ข้อผิดพลาด AJAX: " + status + " " + error);
                    alert("เกิดข้อผิดพลาดในการโหลดข้อมูล");
                },
                columns: [{
                        // ดึงข้อมูลของคอลัมน์ 'id' จาก server-side script
                        data: 'id'
                    },
                    {
                        // ดึงข้อมูลของคอลัมน์ 'name' จาก server-side script
                        data: 'dish_name'
                    },
                    {
                        // ดึงข้อมูลของคอลัมน์ 'email' จาก server-side script
                        // แสดงข้อมูลตามปกติ ไม่ต้องแปลง
                        data: 'price',
                        render: function(data, type, row, meta) {
                            return row.price;
                        },
                        // กำหนด class 'text-center' ให้กับคอลัมน์นี้เพื่อจัดกึ่งกลาง
                        className: 'text-center'
                    },
                    {
                        // ดึงข้อมูลของคอลัมน์ 'role' จาก server-side script
                        // แปลงข้อมูลโดยดึงค่า 'roles_name' จาก object 'role'
                        data: 'category_id',
                        render: function(data, type, row, meta) {
                            return row.category.category;
                        },
                        // กำหนด class 'text-center' ให้กับคอลัมน์นี้เพื่อจัดกึ่งกลาง
                        className: 'text-center'
                    },
                    {
                        // ดึงข้อมูลของคอลัมน์ 'id' จาก server-side script
                        // ไม่ได้ดึงข้อมูลโดยตรง แต่สร้าง HTML button สำหรับการจัดการข้อมูล
                        data: null,
                        render: function(data, type, row, meta) {
                            // สร้าง HTML string สำหรับแสดง button
                            return `
                                <div class="flex justify-center">

                                        <a class="btn-view btn-actions inline-flex items-center flex-grow px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-gray-700 active:bg-gray-900"
                                        data-data='${JSON.stringify(row)}'>

                                            {{ __('View') }}
                                        </a>

                                        <a class="btn-edit btn-actions inline-flex items-center flex-grow px-4 py-2 ml-4 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-gray-700 active:bg-gray-900"
                                        >
                                            {{ __('Edit') }}
                                        </a>

                                        <button type="submit"
                                            class="btn-delete btn-actions inline-flex items-center flex-grow px-4 py-2 ml-4 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-red-700 active:bg-red-900">
                                            {{ __('Delete') }}
                                        </button>

                                </div>
                            `;
                        },
                        // กำหนด class 'text-center' ให้กับคอลัมน์นี้เพื่อจัดกึ่งกลาง
                        className: 'text-center'
                    },
                ],
                // กำหนดค่าคอลัมน์ต่างๆ
                columnDefs: [

                    // กำหนดให้คอลัมน์ 0, 1, 2 responsive มากที่สุด
                    {
                        responsivePriority: 1,
                        targets: [0, 1, 2]
                    },

                    // กำหนดให้คอลัมน์ 1 และ 2 เรียงลำดับได้
                    {
                        orderable: true,
                        targets: [1, 2]
                    },

                    // กำหนดให้คอลัมน์สุดท้าย (คอลัมน์ 3) ไม่เรียงลำดับ
                    {
                        orderable: false,
                        targets: [4]
                    }
                ],

                // กำหนดตัวเลือกจำนวน record ที่แสดงต่อหน้าจอ
                "lengthMenu": [5, 10, 20, 40],
            });

            $(document).on('click', '.btn-view', function() {

                var data = $(this).data('data');
                console.log('เข้าถึง Row ทั้งหมด ที่ส่งมาจาก attribute row data');
                console.log(data);
                console.log('---------------------------------------------------------------------------');

                var rows = list_table.rows().data();
                console.log('เข้าถึง Row ทั้งหมด');
                console.log(rows);
                console.log('---------------------------------------------------------------------------');

                var row = list_table.row($(this).parents('tr')).data();
                console.log('เข้าถึง Row ของปุ่มที่ทำการคลิก');
                console.log(row);
                console.log('---------------------------------------------------------------------------');

                var rowIndex = list_table.row($(this).parents('tr')).index();
                console.log('เข้าถึงตำแหน่งของ Row ของปุ่มที่ทำการคลิก');
                console.log(rowIndex);
                console.log('---------------------------------------------------------------------------');

                // เติมข้อมูลลงใน Modal
                $('#dish_name').val(row.dish_name);
                $('#price').val(row.price);
                $('#category').val(row.category);

                // ตรวจสอบว่า row.roles ว่างหรือไม่
                // if (!row.category || row.category === 'undefined' || row.category === null) {
                //     // Clear Select
                //     $('#category').val('').trigger('change');
                // } else {
                //     // เลือก option ที่มี value ตรงกับ row.id
                //     $('#category').val(row.role.id).trigger('change');
                // }

                // แสดง Modal
                $('#modal-view').show();
            });


            $(document).on('click', '.btn-edit', function() {

                console.log('ปุ่มอัพเดทถูกคลิก');
                var row = list_table.rows().data();
                var row = list_table.row($(this).parents('tr')).data();
                var rowIndex = list_table.row($(this).parents('tr')).index();

                // เติมข้อมูลลงใน Modal

                $('#dish_name').val(row.dish_name);
                $('#price').val(row.price);


                // เปิดการใช้งาน (enable) dropdown หรือ input ที่มี id="roles"
                // โดยตั้งค่า property 'disabled'  $('#roles').prop('disabled', false);

                // กำหนดค่า data attribute ชื่อ 'user' ให้กับปุ่มที่มี class 'btn-sm-update'
                // โดยใช้ค่า ID ของผู้ใช้จาก row.id เพื่อเก็บไว้ใช้งานภายหลัง เช่น สำหรับการอัปเดตข้อมูล
                $('.btn-sm-update').data('id', row.id);
                // แสดง Modal
                $('#modal-view').show();
            });



            // $(document).on('click', '.btn-sm-update', function() {
            //     console.log("ปุ่มอัปเดตถูกคลิก");

            //     // ดึงข้อมูลจาก input ใน modal
            //     var dishId = $(this).data('id'); // เก็บ ID ของ dish ที่จะแก้ไข
            //     const dish_name = document.getElementById('dish_name').value;
            //     const price = document.getElementById('price').value;
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            //         },
            //         xhrFields: {
            //             withCredentials: true
            //         }
            //     });




            //     // ใช้ SweetAlert เพื่อยืนยันการอัพเดท
            //     Swal.fire({
            //         title: "ยืนยันการอัพเดทข้อมูล",
            //         text: "คุณต้องการอัพเดทข้อมูลของ " + dish_name + ' ใช่หรือไม่?',
            //         icon: "warning",
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'ยืนยัน',
            //         cancelButtonColor: 'ยกเลิก',
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             // ส่งข้อมูลผ่าน AJAX
            //             $.ajax({
            //                 type: "PUT", // ใช้ PUT method เพื่ออัพเดทข้อมูล
            //                 url: "{{ route('dish.update') }}", // ตั้งค่ารูทที่คุณใช้ในการอัพเดท
            //                 data: {
            //                     dish_name: dish_name,
            //                     price: price,
            //                     dishId: dishId, // ส่ง ID ของ dish ที่จะอัพเดท
            //                     _token: '{{ csrf_token() }}' // อย่าลืมส่ง CSRF token
            //                 },
            //                 dataType: 'JSON',
            //                 success: function(response) {
            //                     console.log(
            //                         response
            //                     ); // เพิ่มการแสดงผลเพื่อดูข้อมูล response ที่ได้รับจาก server
            //                     if (response.code == 200) {
            //                         Swal.fire({
            //                             title: response.message,
            //                             text: "ข้อมูลผู้ใช้" + dish_name +
            //                                 ' ได้รับการอัพเดทแล้ว ?',
            //                             icon: "success",
            //                         });
            //                         list_table.clear().draw();
            //                     } else {
            //                         Swal.fire({
            //                             title: 'เกิดข้อผิดพลาด',
            //                             text: response.message,
            //                             icon: "error",
            //                             confirmButtonText: 'ตกลง',
            //                         });
            //                     }
            //                 }

            //             });
            //         }
            //     });
            // });


            $(document).on('click', '.btn-sm-update', function() {
                var userId = $(this).data('id'); // ID ของผู้ใช้
                var dish_name = $('#dish_name').val();
                var price = $('#price').val();


                $.ajax({
                    url: `/dish/${userId}`, // แก้ตาม route update ของคุณ เช่น route('users.update', userId)
                    type: 'PUT', // หรือ 'PATCH' แล้วแต่ Laravel route คุณกำหนด
                    data: {
                        dish_name: dish_name,
                        price: price,

                        _token: '{{ csrf_token() }}' // สำคัญ! สำหรับ Laravel
                    },
                    success: function(response) {
                        // ซ่อน modal
                        $('#modal-view').hide();

                        // รีเฟรชตาราง
                        $('#table-users').DataTable().ajax.reload(null, false);

                        // แสดง SweetAlert สำหรับการอัพเดทสำเร็จ
                        Swal.fire({
                            title: 'อัพเดทข้อมูลสำเร็จ',
                            text: 'ข้อมูลผู้ใช้ ' + dish_name + ' ได้รับการอัพเดทแล้ว!',
                            icon: 'success',
                            confirmButtonText: 'ตกลง'
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status !== 200) {
                            var response = xhr.responseJSON || xhr.responseText;
                            console.log(response);

                            // แสดง SweetAlert สำหรับข้อผิดพลาด
                            Swal.fire({
                                title: 'เกิดข้อผิดพลาด',
                                text: response.message || 'ไม่สามารถอัพเดทข้อมูลได้',
                                icon: 'error',
                                confirmButtonText: 'ตกลง'
                            });
                        } else {
                            Swal.fire({
                                title: 'อัพเดทข้อมูลสำเร็จ',
                                text: 'ข้อมูลผู้ใช้ ' + name + ' ได้รับการอัพเดทแล้ว!',
                                icon: 'success',
                                confirmButtonText: 'ตกลง'
                            });
                        }
                    }
                });
            });


            $(document).on('click', '.btn-delete', function() {
                console.log("ปุ่มลบถูกคลิก");
                var row = list_table.row($(this).parents('tr')).data()
                var dishId = row.id;

                Swal.fire({
                    title: "ยืนยันการลบข้อมูล",
                    text: "คุณต้องการลบข้อมูลผู้ใช้" + dishId + ' ใช่หรือไม่ ?',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancleButtonColor: '#d33',
                    confirmButtonText: 'ยืนยัน',
                    cancleButtonColor: 'ยกเลิก',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "delete",
                            url: "{{ route('dish.delete') }}",
                            data: {

                                dishId: dishId,
                            },
                            dataType: 'JSON',
                            headers: {},
                            success: function(response) {
                                if (response.code == 200) {
                                    Swal.fire({

                                        title: response.message,
                                        text: "ข้อมูลผู้ใช้" +
                                        dishId + ' ได้รับการลบแล้ว ?',
                                        icon: "success",
                                    });
                                    list_table.clear().draw();
                                } else {
                                    Swal.fire({

                                        title: 'เกิดข้อผิดพลาด',
                                        text: response.message,
                                        icon: "error",
                                        confirmButtonText: 'ตกลง',
                                    });
                                }
                            }
                        })
                    }
                });
            });

            $(document).on('click', '#modal-view button', function() {
                $('#modal-view').hide();
            });

        });
    </script>
@endscript
