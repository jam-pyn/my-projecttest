<style>
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-error {
        color: #c40d00;
        background-color: #edd4d4;
        border-color: #e6c3c3;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
</style>
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
                                <label for="dish_name" class="block text-sm font-medium text-gray-700">ชื่ออาหาร</label>
                                <input type="text" name="dish_name" id="dish_name"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="price" class="block text-sm font-medium text-gray-700">ราคา</label>
                                <input type="text" name="price" id="price"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                            </div>
                            <!-- กล่องเลือกประเภทอาหาร -->
                            <div class="col-span-6 sm:col-span-4">
                                <!-- ป้ายบอกรายการให้กรอกประเภทอาหาร -->
                                <label for="category" class="block text-sm font-medium text-gray-700">ประเภทอาหาร</label>

                                <!-- ช่องเลือก (dropdown) สำหรับเลือกประเภทอาหาร -->
                                <select name="category" id="category"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                                    <!-- ลูปแสดงรายการประเภทอาหารทั้งหมดจากตัวแปร $categorys -->
                                    @foreach ($categorys as $category)
                                    <!-- สร้างตัวเลือก (option) สำหรับแต่ละประเภทอาหาร -->
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                    </form>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:py-4">
                    <div class="flex flex-row-reverse">
                        <button type="button"
                            class="btn-sm-update mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                            อัพเดทข้อมูล
                        </button>
                        <button type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
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


        // console.log("hello" + "{{ env('TOKEN_API') }}");

        // กำหนด DataTable ให้กับ element `#table-users`
        var list_table = $('#table-dishes').DataTable({

            dom: '<"flex justify-between items-center mb-4"lf>rt<"flex justify-between items-center mt-4"ip>',
            // กำหนดจำนวน record ที่แสดงต่อหน้าจอ เริ่มต้นที่ 5 record
            pageLength: 10,
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
                url: "{{ route('dish.with.datatable')}}",

                // กำหนด method การส่งข้อมูล
                type: "post",

                // กำหนด header เพิ่มเติม
                beforeSend: function(xhr) {
                    const bearerToken = "{{ env('TOKEN_API') }}";
                    xhr.setRequestHeader('Authorization',
                        'Bearer ' + bearerToken);
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
    <!-- ปุ่ม View: ใช้สำหรับแสดงรายละเอียดของข้อมูลรายการนั้นๆ -->
    <!-- data-data เก็บข้อมูลทั้งแถวในรูปแบบ JSON (ใช้ใน JavaScript เช่นเปิด Modal) -->
    <!-- data-data1 เก็บค่าคงที่ เช่น ใช้ระบุโหมดหรือประเภทของ modal ที่จะเปิด -->
    <a class="btn-view btn-actions inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-gray-700 active:bg-gray-600"
        data-data='${JSON.stringify(row)}' 
        data-data1='${2}'>
        {{ __('View') }} 
    </a>

    <!-- ปุ่ม Edit: ใช้สำหรับเปิดแบบฟอร์มแก้ไขข้อมูล -->
    <!-- data-dish เก็บ ID ของรายการอาหารไว้ เพื่อส่งไปดึงข้อมูลจาก backend หรือเปิด modal สำหรับแก้ไข -->
    <a class="btn-edit btn-actions inline-flex items-center px-4 py-2 ml-4 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-gray-700 active:bg-gray-900"
        data-dish='${row.id}'>
        {{ __('Edit') }} 
    </a>
    <button type="submit"
        class="btn-delete btn-actions inline-flex items-center px-4 py-2 ml-4 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-red-700 active:bg-red-900">
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

            // ดึงข้อมูลจาก attribute ชื่อ 'data-data' ของ element ที่ถูกคลิก แล้วเก็บไว้ในตัวแปร data1
            //this ในบริบทนี้จะหมายถึง ปุ่มที่ถูกคลิก
            //และ $(this) จะเปลี่ยนจาก JavaScript element ให้กลายเป็น jQuery object เพื่อให้ใช้คำสั่ง jQuery ได้ง่าย เช่น .data(), .val(), .addClass()
            var data1 = $(this).data('data');

            //this = element ที่ถูกคลิก (ในรูปแบบดิบ ๆ ของ JavaScript)
            //$(this) = element เดิม แต่อยู่ในรูปแบบ jQuery (ใช้งานกับ jQuery ได้ทันที)

            var data2 = $(this).data('data1');

            console.log('เข้าถึง Row ทั้งหมด ที่ส่งมาจาก attribute row data');
            console.log(data1);
            console.log(data2);
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
            $('#categorys').val(row.categorys);


            if (!row.category || row.category === 'undefined' || row.category === null) {
                // Clear Select
                $('#category').val('').trigger('change');
            } else {
                // เลือก option ที่มี value ตรงกับ row.id
                $('#category').val(row.category.id).trigger('change');
            }

            // แสดง Modal
            $('#modal-view').show();
        });


        $(document).on('click', '.btn-edit', function() {

            console.log('ปุ่มอัพเดทถูกคลิก');
            // ดึงข้อมูลทั้งหมดจากแถวในตาราง 'list_table'
            // โดยใช้ฟังก์ชัน rows() เพื่อเลือกทุกรายการในตาราง แล้วใช้ data() เพื่อดึงข้อมูลทั้งหมดที่อยู่ในแถวเหล่านั้น
            var row = list_table.rows().data();
            //var คือการประกาศตัวแปร

            // ดึงข้อมูลจากแถวที่ถูกคลิก (แถวที่เป็นต้นทางของเหตุการณ์ที่เกิดขึ้น)
            // $(this).parents('tr') ใช้เลือกแถว <tr> ที่คลิกอยู่ จากนั้นใช้ .data() เพื่อดึงข้อมูลในแถวนั้น
            var row = list_table.row($(this).parents('tr')).data();

            // ดึง index หรือหมายเลขลำดับของแถวที่ถูกคลิก (แถวที่เป็นต้นทางของเหตุการณ์)
            // $(this).parents('tr') เลือกแถว <tr> ที่คลิกอยู่ จากนั้น .index() จะให้ค่าลำดับที่ของแถวในตาราง
            var rowIndex = list_table.row($(this).parents('tr')).index();


            // เติมข้อมูลลงใน Modal

            // ตั้งค่าช่องกรอกชื่ออาหาร (dish_name) ในฟอร์ม ให้มีค่าเท่ากับค่าของ dish_name ที่อยู่ในตัวแปร row
            $('#dish_name').val(row.dish_name);

            // ตั้งค่าช่องกรอกราคา (price) ในฟอร์ม ให้มีค่าเท่ากับค่าของ price ที่อยู่ในตัวแปร row
            $('#price').val(row.price);

            // ตั้งค่าช่องเลือกประเภทอาหาร (category) ในฟอร์ม ให้มีค่าเท่ากับค่าของ category ที่อยู่ในตัวแปร row
            $('#category').val(row.category);


            if (!row.category || row.category === 'undefined' || row.category === null) {
                // Clear Select
                $('#category').val('').trigger('change');
            } else {
                // เลือก option ที่มี value ตรงกับ row.id
                $('#category').val(row.category.id).trigger('change');
            }
            // กำหนดค่า data attribute ชื่อ 'dish' ให้กับปุ่มที่มี class 'btn-sm-update'
            // โดยใช้ค่า ID ของผู้ใช้จาก row.id เพื่อเก็บไว้ใช้งานภายหลัง เช่น สำหรับการอัปเดตข้อมูล
            $('.btn-sm-update').data('dish', row.id);
            // แสดง Modal
            $('#modal-view').show();
        });


        // เมื่อคลิกปุ่มที่มีคลาส .btn-sm-update (ปุ่มอัปเดต)
        $(document).on('click', '.btn-sm-update', function() {
            console.log("ปุ่มอัปเดตถูกคลิก"); // แสดงข้อความใน console เพื่อ debug
           
            var dish_id = $(this).data('dish'); // ดึงค่า ID ของ dish จาก attribute data-dish ของปุ่มที่ถูกคลิก
            console.log(dish_id); // แสดงค่า dish_id ใน console

            // ดึงค่าจากฟอร์ม input ที่ผู้ใช้กรอกไว้ 
            // getElementById คือฟังก์ชันใน JavaScript ที่ใช้สำหรับเลือกและเข้าถึงองค์ประกอบ (element) ในหน้าเว็บ
            //  (HTML) โดยการใช้ id ที่กำหนดไว้ในองค์ประกอบนั้นๆ

            //const คือ การกำหนดตัวแปรใน javascript
            const dish_name = document.getElementById('dish_name').value;
            const price = document.getElementById('price').value;
            const category = document.getElementById('category').value;

            // สร้าง object สำหรับเก็บข้อมูลที่จะส่งไปอัปเดต
            const update_data = {
                dish_name: dish_name,
                price: price,
                category_id: category,
            };

            // แสดง popup เพื่อให้ผู้ใช้ยืนยันก่อนจะส่งข้อมูลไปอัปเดต
            Swal.fire({
                title: "ยืนยันการอัพเดทข้อมูล", // หัวข้อของ popup
                text: "คุณต้องการอัพเดทข้อมูลผู้ใช้ " + dish_name + ' ใช่หรือไม่ ?', // ข้อความแจ้งเตือน
                icon: "warning", // ไอคอนแสดงเป็นรูปเตือน
                showCancelButton: true, // แสดงปุ่มยกเลิก
                confirmButtonColor: '#3085d6', // สีของปุ่มยืนยัน
                cancleButtonColor: '#d33', //  สีปุ่มยกเลิก
                confirmButtonText: 'ยืนยัน', // ข้อความบนปุ่มยืนยัน
                cancleButtonColor: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) { // ถ้าผู้ใช้กด "ยืนยัน"
                    $.ajax({
                        type: "put", // ใช้ HTTP PUT สำหรับอัปเดตข้อมูล
                        url: "{{ route('dish.update') }}", // URL ไปยัง route ที่จะใช้รับข้อมูลอัปเดต
                        data: {
                            updateData: update_data, // ส่งข้อมูลที่ต้องการอัปเดต
                            dishId: dish_id // ส่ง ID ของ dish ที่จะอัปเดต
                        },
                        dataType: 'JSON', // กำหนดประเภทข้อมูลที่ส่งเป็น JSON

                        headers: {}, // เริ่มต้นเป็น object เปล่าไว้สำหรับเพิ่ม header
                        beforeSend: function(xhr) {
                            // เพิ่ม Header Authorization โดยดึง Token จาก .env
                            const bearerToken = "{{ env('TOKEN_API') }}";
                            xhr.setRequestHeader('Authorization', 'Bearer ' + bearerToken);
                        },

                        // ฟังก์ชันที่จะทำงานเมื่ออัปเดตสำเร็จหรือมีผลลัพธ์จากเซิร์ฟเวอร์
                        success: function(response) {
                            if (response.code == 200) { // ถ้าอัปเดตสำเร็จ
                                Swal.fire({
                                    title: response.message, // แสดงข้อความตอบกลับจากเซิร์ฟเวอร์
                                    text: "ข้อมูลผู้ใช้ " + dish_name + ' ได้รับการอัพเดทแล้ว',
                                    icon: "success", // แสดงไอคอนสำเร็จ
                                });
                                list_table.clear().draw(); // เคลียร์และโหลดข้อมูลใหม่ในตาราง
                            } else { // ถ้ามีข้อผิดพลาดจากเซิร์ฟเวอร์
                                Swal.fire({
                                    title: 'เกิดข้อผิดพลาด',
                                    text: response.message,
                                    icon: "error", // แสดงไอคอน error
                                    confirmButtonText: 'ตกลง',
                                });
                            }
                        }
                    })
                }
            });
        });





        $(document).on('click', '.btn-delete', function() {
            console.log("ปุ่มลบถูกคลิก");

            // ดึงข้อมูลของแถว (row) ที่ผู้ใช้คลิกที่ปุ่มลบ
            var row = list_table.row($(this).parents('tr')).data();
            var dishId = row.id; // ดึงค่า 'id' จากข้อมูลในแถว (row)

            // แสดงหน้าต่างยืนยันการลบข้อมูล (SweetAlert)
            Swal.fire({
                title: "ยืนยันการลบข้อมูล",
                text: "คุณต้องการลบข้อมูลผู้ใช้ " + dishId + ' ใช่หรือไม่ ?',
                icon: "warning", // ใช้ไอคอนเตือนภัย
                showCancelButton: true, // ให้แสดงปุ่มยกเลิก
                confirmButtonColor: '#3085d6', // สีปุ่มยืนยัน
                cancleButtonColor: '#d33', // สีปุ่มยกเลิก
                confirmButtonText: 'ยืนยัน', // ข้อความในปุ่มยืนยัน
                cancleButtonColor: 'ยกเลิก', // ข้อความในปุ่มยกเลิก
            }).then((result) => {
                // ตรวจสอบว่าผู้ใช้คลิกปุ่มยืนยัน (confirm) หรือไม่
                if (result.isConfirmed) {
                    // ถ้าคลิกยืนยัน ให้ส่งคำขอลบข้อมูลไปยังเซิร์ฟเวอร์
                    $.ajax({
                        type: "delete", // ใช้ HTTP method DELETE
                        url: "{{ route('dish.delete') }}", // URL สำหรับการลบข้อมูล
                        data: {
                            deleteId: dishId, // ส่งค่า dishId ไปเพื่อให้เซิร์ฟเวอร์รู้ว่าต้องลบข้อมูลอะไร
                        },
                        dataType: 'JSON', // กำหนดให้รับข้อมูลเป็น JSON
                        headers: {},
                        beforeSend: function(xhr) {
                            const bearerToken = "{{ env('TOKEN_API') }}"; // หาค่า API Token จาก env
                            xhr.setRequestHeader('Authorization', 'Bearer ' + bearerToken); // ใส่ Bearer token ใน header
                        },
                        success: function(response) {
                            if (response.code == 200) {
                                // ถ้าลบสำเร็จ ให้แสดงการแจ้งเตือนว่า "ลบสำเร็จ"
                                Swal.fire({
                                    title: response.message, // แสดงข้อความจาก response
                                    text: "ข้อมูลผู้ใช้ " + dishId + ' ได้รับการลบแล้ว ?',
                                    icon: "success", // ไอคอนสำหรับแสดงผลสำเร็จ
                                });
                                // รีเฟรชตารางข้อมูล
                                list_table.clear().draw();
                            } else {
                                // ถ้ามีข้อผิดพลาดให้แสดงการแจ้งเตือนว่า "เกิดข้อผิดพลาด"
                                Swal.fire({
                                    title: 'เกิดข้อผิดพลาด',
                                    text: response.message,
                                    icon: "error", // ไอคอนสำหรับข้อผิดพลาด
                                    confirmButtonText: 'ตกลง', // ข้อความในปุ่มยืนยัน
                                });
                            }
                        }
                    })
                }
            });
        });


    });
</script>
@endscript