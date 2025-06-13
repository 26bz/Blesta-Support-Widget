<?php
class AdminMain extends SupportWidgetController
{
    public function preAction()
    {
        parent::preAction();
        $this->requireLogin();
    }

    public function index()
    {
        $tickets = [];

        try {
            Loader::loadModels($this, ['SupportManager.SupportManagerTickets']);

            $tickets = $this->SupportManagerTickets->getList(
                'not_closed',
                null,
                null,
                1,
                ['last_reply_date' => 'desc'],
                false,
                null,
                []
            );

            if (empty($tickets)) {
                $tickets = $this->SupportManagerTickets->getList(
                    null,
                    null,
                    null,
                    1,
                    ['last_reply_date' => 'desc'],
                    false,
                    null,
                    []
                );
            }

            if (is_array($tickets) && count($tickets) > 10) {
                $tickets = array_slice($tickets, 0, 10);
            }
        } catch (Exception $e) {
            $tickets = [
                (object)[
                    'id' => 1,
                    'code' => 'ERROR-' . date('His'),
                    'summary' => 'Support Manager not available',
                    'status' => 'error',
                    'department_name' => 'System',
                    'last_reply_date' => date('Y-m-d H:i:s'),
                    'priority' => 'low'
                ]
            ];
        }

        $this->set('tickets', $tickets);

        return $this->renderAjaxWidgetIfAsync();
    }
}
