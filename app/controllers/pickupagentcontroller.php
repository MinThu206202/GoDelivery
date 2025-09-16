<?php
session_start();
class pickupagentcontroller extends Controller
{

    private $db;
    private $pickup_agent;

    public function __construct()
    {
        $this->db = new Database();
        $this->model('notification');
        $this->model('paymenthistoryModel');
        $this->model('notification');
        $this->pickup_agent = $_SESSION['user'];
    }

    public function Dashboard()
    {
        $allpickupdata = $this->db->columnFilterAll('pickup_requests_view', 'pickup_agent_id', $this->pickup_agent['id']);
        $data = [
            'allpickupdata' => $allpickupdata,
        ];
        $this->view('pickupagent/Dashboard', $data);
    }

    public function mypick()
    {
        $allpickupdata = $this->db->columnFilterAll('pickup_requests_view', 'pickup_agent_id', $this->pickup_agent['id']);

        // $allpickupdata = array_filter($allpickupdata, function ($pickup) {
        //     return $pickup['status'] !== 'pending';
        // });
        $data = [
            'allpickupdata' => $allpickupdata,
        ];

        $this->view('pickupagent/mypickup', $data);
    }
    public function pickupagentprofile()
    {
        $profile = $this->db->getById('user_full_info', $this->pickup_agent['id']);
        $allpickupdata = $this->db->columnFilterAll('pickup_requests_view', 'pickup_agent_id', $this->pickup_agent['id']);
        $data = [
            'profile' => $profile,
            'allpickupdata' => $allpickupdata,
        ];
        $this->view('pickupagent/agentpickupprofile', $data);
    }

    public function notification()
    {
        $noti = $this->db->columnFilterAll('view_agent_messages', 'to_agent_id', $this->pickup_agent['id']);
        $data = [
            'noti' => $noti,
        ];
        $this->view('pickupagent/pickupagentnotification', $data);
    }

    public function pickupdetail()
    {
        $request_code = $_GET['request_code'];
        $pickupdetail = $this->db->columnFilter('pickup_requests_view', 'request_code', $request_code);
        $data = [
            'pickupdetial' => $pickupdetail,
        ];
        $this->view('pickupagent/pickupagent_pickupdetail', $data);
    }

    public function pickupagent_pickupdetail()
    {
        $this->view('pickupagent/pickupagent_pickupdetail');
    }

    public function startpickup()
    {
        $pickup_id = $_GET['id'];
        $requestCode = $this->db->getById('pickup_requests', $pickup_id);

        $notificationText = "🚚 Your pickup agent is on the way for request #"
            . $requestCode['request_code']
            . ". Please be ready at " . $requestCode['sender_address'] . ".";

        $noti = new Notification();
        $noti->setFromagentid($requestCode['pickup_agent_id']);
        $noti->setToagentid($requestCode['sender_id']);
        $noti->setTypeid(6);
        $noti->setTitle("pickup agent on the way");
        $noti->setMessage($notificationText);
        $this->db->create('agent_notifications', $noti->toArray());

        $result = $this->db->update('pickup_requests', $pickup_id, ['status_id' => 4]);
        redirect('pickupagentcontroller/mypick');
        return;
    }

    public function editpickup()
    {
        $request_code = $_GET['request_code'];
        $request_id = $_GET['id'];
        $weight = $_GET['weight'];
        $quantity = $_GET['quantity'];
        $payment_type = $_GET['payment_type'];
        $delivery_type = $_GET['delivery_type'];

        $result = $this->db->update(
            'pickup_requests',
            $request_id,
            [
                'weight' => $weight,
                'quantity' => $quantity,
                'delivery_type_id' => $delivery_type,
                'payment_status_id' => $payment_type
            ]
        );

        // ✅ Set flash message in session
        if ($result) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Pickup updated successfully!'
            ];
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Failed to update pickup. Please try again.'
            ];
        }

        redirect('pickupagentcontroller/pickupdetail?request_code=' . $request_code);
        return;
    }

    public function verifypickup()
    {
        $id = $_GET['id'];
        $request_code = $this->db->getById('pickup_requests', $id);
        $route = $this->db->checkroute('route', $request_code['sender_township_id'], $request_code['receiver_township_id']);

        $totalPrice = (float)$request_code['weight'] * (float) $route['price'];



        $result =  $this->db->update('pickup_requests', $id, ['status_id' => 9, 'amount' => $totalPrice]);
        // var_dump($result);
        // die();
        if ($result) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Pickup verified successfully!'
            ];
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Failed to verify pickup. Please try again.'
            ];
        }


        redirect('pickupagentcontroller/pickupdetail?request_code=' . $request_code['request_code']);
        return;
    }

    public function completepickup()
    {

        $outofdelivery = $this->db->readAll('view_deliveries_detailed');
        $filteredDeliveries = array_filter($outofdelivery, function ($delivery) {
            return $delivery['pickupagent_id'] == $this->pickup_agent['id'];
        });
        $data = [
            'alldata' => $filteredDeliveries,
        ];
        $this->view('pickupagent/completepickup', $data);
        return;
    }

    public function arrived()
    {
        $id = $_GET['id'];
        $request_code = $_GET['request_code'] ?? null;
        $this->db->update('pickup_requests', $id, ['status_id' => 17]);
        redirect('pickupagentcontroller/pickupdetail?request_code=' . $request_code);
        return;
    }

    public function pickupfail()
    {
        $id = $_GET['id'];
        $request_code = $_GET['request_code'] ?? null;
        $this->db->update('pickup_requests', $id, ['status_id' => 19]);
        redirect('pickupagentcontroller/pickupdetail?request_code=' . $request_code);
        return;
    }

    public function collectcash()
    {
        $id = $_GET['id'];
        $this->db->update('pickup_requests', $id, ['status_id' => 16]);
        redirect('pickupagentcontroller/mypick');
        return;
    }

    public function complete()
    {
        $id = $_GET['id'];
        $request_code = $_GET['request_code'] ?? null;
        $this->db->update('pickup_requests', $id, ['status_id' => 3]);
        redirect('pickupagentcontroller/pickupdetail?request_code=' . $request_code);
        return;
    }
    public function deliverparcel()
    {
        $id = $_GET['id'];
        $this->db->update('deliveries', $id, ['delivery_status_id' => 9]);
        redirect('pickupagentcontroller/completepickup');
        return;
    }

    public function outofdeliverydetail()
    {
        $agentId = $this->pickup_agent['created_by_agent'];
        $request_code = $_GET['request_code'];
        $payment = $this->db->readAll('payment_methods_view');
        $paymenttype = array_filter($payment, function ($method) use ($agentId) {
            return $method['create_by_agent_id'] == $agentId;
        });
        $pickupdetail = $this->db->columnFilter('view_deliveries_detailed', 'tracking_code', $request_code);
        $data = [
            'payment' => $paymenttype,
            'pickupdetial' => $pickupdetail,
        ];
        $this->view('pickupagent/outdelivery_detail', $data);
    }

    public function arrivedoutofdelivery()
    {
        $id = $_GET['id'] ?? null;
        $request_code = $_GET['request_code'] ?? null;

        if (!$id) {
            redirect('pickupagentcontroller/outofdelivery');
            return;
        }

        $delivery = $this->db->getById('view_deliveries_detailed', $id);

        if ($delivery) {
            // Map payment status to delivery status
            $statusMap = [
                1 => 3,  // prepaid → delivered
                2 => 10  // COD → some other status
            ];

            date_default_timezone_set('Asia/Yangon');

            // ✅ Only send email if delivery status will be 3
            if (isset($statusMap[$delivery['payment_status_id']]) && $statusMap[$delivery['payment_status_id']] == 3) {
                $this->db->create(
                    'agent_notifications',
                    [
                        'from_agent_id' => $delivery['receiver_agent_id'],
                        'to_agent_id'   => $delivery['sender_agent_id'],
                        'type_id'       => 2,
                        'title'         => 'Delivery Successful!',
                        'message'       => "Your delivery with tracking code $request_code has been successfully delivered to the customer.",
                        'created_at'    => date('Y-m-d H:i:s')
                    ]
                );

                // Send mail only when status = 3
                (new Mail)->deliverysuccess(
                    $delivery['sender_customer_email'],
                    $delivery['sender_customer_name'],
                    $delivery['tracking_code'],
                    $delivery['to_township_name']
                );

                (new Mail)->deliverysuccessforreceiver(
                    $delivery['receiver_customer_email'],
                    $delivery['receiver_customer_name'],
                    $delivery['tracking_code'],
                    $delivery['to_township_name']
                );
            }

            // ✅ Always update delivery status (regardless of mail)
            if (isset($statusMap[$delivery['payment_status_id']])) {
                $this->db->update(
                    'deliveries',
                    $id,
                    ['delivery_status_id' => $statusMap[$delivery['payment_status_id']]]
                );
            }
        }

        redirect('pickupagentcontroller/outofdeliverydetail?request_code=' . $request_code);
    }



    public function outofdeliveryreturn()
    {
        $id = $_GET['id'];
        $request_code = $_GET['request_code'] ?? null;
        $this->db->update('deliveries', $id, ['delivery_status_id' => 5]);
        redirect('pickupagentcontroller/outofdeliverydetail?request_code=' . $request_code);
        return;
    }

    public function savepayment()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $payment_type = $_POST['payment_type'];
            $method_id = $_POST['method_id'];
            $agent_id = $_POST['agent_id'];
            $delivery_id = $_POST['delivery_id'];
            $payment_image = null;
            $agent = $this->db->getById('users', $agent_id);

            if ($payment_type == 1) {
                $this->db->update('deliveries', $delivery_id, ['delivery_status_id' => 3]);

                $request_code = $this->db->getById('deliveries', $delivery_id);
                redirect("pickupagentcontroller/outofdeliverydetail?request_code={$request_code['tracking_code']}");
                return;
            }

            // --- Handle file upload ---
            if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] !== UPLOAD_ERR_NO_FILE) {
                $file = $_FILES['receipt'];

                // Upload directory
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/Delivery/public/uploads/";

                // Ensure folder exists
                if (!is_dir($uploadDir)) {
                    if (!mkdir($uploadDir, 0755, true)) {
                        throw new Exception("Failed to create upload folder: " . $uploadDir);
                    }
                }

                // Check writable
                if (!is_writable($uploadDir)) {
                    throw new Exception("Upload folder is not writable: " . $uploadDir);
                }

                // Validate file size (max 5MB)
                $maxFileSize = 5 * 1024 * 1024; // 5MB
                if ($file['size'] > $maxFileSize) {
                    throw new Exception("File is too large. Max 5MB.");
                }

                // Validate MIME type
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/avif'];
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($finfo, $file['tmp_name']);
                finfo_close($finfo);

                if (!in_array($mimeType, $allowedMimeTypes)) {
                    throw new Exception("Invalid file type. Only JPG, PNG, AVIF, GIF allowed.");
                }

                // Sanitize and create unique filename
                $originalName  = pathinfo($file['name'], PATHINFO_FILENAME);
                $extension     = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $sanitizedBase = preg_replace("/[^A-Za-z0-9_\-]/", '', $originalName);
                $sanitizedBase = substr($sanitizedBase, 0, 50);
                $newFileName   = uniqid('payment_', true) . '_' . $sanitizedBase . '.' . $extension;

                $targetPath = $uploadDir . $newFileName;

                // Move uploaded file
                if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
                    throw new Exception("Failed to move uploaded file.");
                }

                // Save path relative to project
                $payment_image = 'public/uploads/' . $newFileName;
            }

            $payment = new paymenthistoryModel();
            $payment->deliveries_id = $delivery_id;
            $payment->payment_method_id = $method_id;
            $payment->agent_id = $agent['created_by_agent'];
            $payment->receipt_image = $payment_image;
            date_default_timezone_set('Asia/Yangon');
            $payment->created_at = date('Y-m-d H:i:s');
            $this->db->create('payment_history', $payment->toArray());
            $this->db->update('deliveries', $delivery_id, ['delivery_status_id' => 11]);

            $request_code = $this->db->getById('deliveries', $delivery_id);
            redirect("pickupagentcontroller/outofdeliverydetail?request_code={$request_code['tracking_code']}");
            return;
        }
    }

    public function updateProfile()
    {
        $id = $_POST['user_id'];
        $name = $_POST['name'];
        $profile_image = null;

        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] !== UPLOAD_ERR_NO_FILE) {
            $file = $_FILES['profile_image'];

            // Upload directory
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/Delivery/public/uploads/";

            // Ensure folder exists
            if (!is_dir($uploadDir)) {
                if (!mkdir($uploadDir, 0755, true)) {
                    throw new Exception("Failed to create upload folder: " . $uploadDir);
                }
            }

            // Check writable
            if (!is_writable($uploadDir)) {
                throw new Exception("Upload folder is not writable: " . $uploadDir);
            }

            // Validate file size (max 5MB)
            $maxFileSize = 5 * 1024 * 1024; // 5MB
            if ($file['size'] > $maxFileSize) {
                throw new Exception("File is too large. Max 5MB.");
            }

            // Validate MIME type
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/avif'];
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);

            if (!in_array($mimeType, $allowedMimeTypes)) {
                throw new Exception("Invalid file type. Only JPG, PNG, AVIF, GIF allowed.");
            }

            // Sanitize and create unique filename
            $originalName  = pathinfo($file['name'], PATHINFO_FILENAME);
            $extension     = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $sanitizedBase = preg_replace("/[^A-Za-z0-9_\-]/", '', $originalName);
            $sanitizedBase = substr($sanitizedBase, 0, 50);
            $newFileName   = uniqid('payment_', true) . '_' . $sanitizedBase . '.' . $extension;

            $targetPath = $uploadDir . $newFileName;

            // Move uploaded file
            if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
                throw new Exception("Failed to move uploaded file.");
            }

            // Save path relative to project
            $profile_image = 'public/uploads/' . $newFileName;
        }
        $redult = $this->db->update('users', $id, ['name' => $name, 'profile_image' => $profile_image]);
        redirect('pickupagentcontroller/pickupagentprofile');
        return;
    }

    public function arrived_at_office()
    {
        $id = $_GET['id'];
        $request_code = $_GET['request_code'] ?? null;
        $this->db->update('pickup_requests', $id, ['status_id' => 18]);
        redirect('pickupagentcontroller/pickupdetail?request_code=' . $request_code);
        return;
    }

    public function completedelivery()
    {
        $id = $_GET['id'];
        $request_code = $_GET['request_code'];
        $delivery = $this->db->getById('view_deliveries_detailed', $id);
        $this->db->create(
            'agent_notifications',
            [
                'from_agent_id' => $delivery['receiver_agent_id'],
                'to_agent_id'   => $delivery['sender_agent_id'],
                'type_id'       => 2,
                'title'         => 'Delivery Successful!',
                'message'       => "Your delivery with tracking code $request_code has been successfully delivered to the customer.",
                'created_at'    => date('Y-m-d H:i:s')
            ]
        );

        // Send mail only when status = 3
        (new Mail)->deliverysuccess(
            $delivery['sender_customer_email'],
            $delivery['sender_customer_name'],
            $delivery['tracking_code'],
            $delivery['to_township_name']
        );

        (new Mail)->deliverysuccessforreceiver(
            $delivery['receiver_customer_email'],
            $delivery['receiver_customer_name'],
            $delivery['tracking_code'],
            $delivery['to_township_name']
        );
        $this->db->update('deliveries', $id, ['delivery_status_id' => 3]);
        redirect('pickupagentcontroller/outofdeliverydetail?request_code=' . $request_code);
        return;
    }
}