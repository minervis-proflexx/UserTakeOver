<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use srag\Plugins\UserTakeOver\Group\IGroupRepository;
use srag\Plugins\UserTakeOver\Group\Group;
use srag\DIC\UserTakeOver\DICTrait;
use ILIAS\DI\RBACServices;

/**
 * @author       Benjamin Seglias <bs@studer-raimann.ch>
 * @author       Thibeau Fuhrer <thibeau@sr.solutions>
 * @noinspection AutoloadingIssuesInspection
 */
class ilUserTakeOverGroupsTableGUI extends ilTable2GUI
{
    use DICTrait;

    public const PLUGIN_CLASS_NAME = ilUserTakeOverPlugin::class;
    public const TBL_ID = 'tbl_usrto_grps';

    /**
     * @var IGroupRepository
     */
    protected $group_repository;
    /**
     * @var ilUserTakeOverGroupsGUI
     */
    protected $parent_obj;
    /**
     * @var array
     */
    protected $filter = array();
    /**
     * @var RBACServices
     */
    protected $rbac;

    /**
     * @param string $a_parent_cmd
     */
    public function __construct(
        IGroupRepository $group_repository,
        ilUserTakeOverGroupsGUI $a_parent_obj,
        $a_parent_cmd
    ) {
        $this->group_repository = $group_repository;
        $this->parent_obj = $a_parent_obj;
        $this->rbac = self::dic()->rbac();

        $this->setId(self::TBL_ID);
        $this->setPrefix(self::TBL_ID);
        $this->setFormName(self::TBL_ID);
        self::dic()->ctrl()->saveParameterByClass(ilUserTakeOverGroupsGUI::class, $this->getNavParameter());

        parent::__construct($a_parent_obj, $a_parent_cmd);
        $this->parent_obj = $a_parent_obj;
        $this->setRowTemplate(
            'tpl.groups.html',
            ilUserTakeOverPlugin::PLUGIN_BASE
        );
        $this->setFormAction(
            self::dic()->ctrl()->getFormActionByClass([ilUserTakeOverMainGUI::class, ilUserTakeOverGroupsGUI::class])
        );
        $this->setExternalSorting(true);
        $this->initColums();
        $this->addFilterItems();
        $this->parseData();
    }

    protected function addFilterItems()
    {
        $title = new ilTextInputGUI(self::plugin()->translate('title'), 'title');
        $this->addAndReadFilterItem($title);

        $number_of_members = new ilTextInputGUI(
            self::plugin()->translate('minimum_number_of_members'),
            'number_of_members'
        );
        $this->addAndReadFilterItem($number_of_members);
    }

    /**
     * @param $item
     */
    protected function addAndReadFilterItem(ilFormPropertyGUI $item)
    {
        $this->addFilterItem($item);
        $item->readFromSession();
        if ($item instanceof ilCheckboxInputGUI) {
            $this->filter[$item->getPostVar()] = $item->getChecked();
        } else {
            $this->filter[$item->getPostVar()] = $item->getValue();
        }
    }

    /**
     * @param array $a_set
     */
    public function fillRow($a_set)
    {
        $group = $this->group_repository->getGroup((int) $a_set[Group::F_ID]);
        if (null === $group) {
            return;
        }

        $this->tpl->setCurrentBlock('tbl_content');
        $this->tpl->setVariable('TITLE', $group->getTitle());
        $this->tpl->setVariable('NUMBER_OF_MEMBERS', $a_set['count']);
        $this->tpl->setVariable('ALLOWED_ROLES', $this->getAllowedRolesString($group));
        $this->tpl->setVariable('RESTRICTED_TO_MEMBERS', self::plugin()->translate(
            $group->isRestrictedToMembers() ? 'yes' : 'no'
        ));
        $this->addActionMenu($group);
        $this->tpl->parseCurrentBlock();
    }

    protected function initColums()
    {
        $this->addColumn(self::plugin()->translate('name_grp'), 'title');
        $this->addColumn(self::plugin()->translate('number_of_members'), 'count');
        $this->addColumn(self::plugin()->translate('restricted_to_members'));
        $this->addColumn(self::plugin()->translate('allowed_roles'));
        $this->addColumn(self::plugin()->translate('common_actions'), '', '150px');
    }

    protected function getAllowedRolesString(Group $group): string
    {
        if (!$group->isRestrictedToRoles()) {
            return '-';
        }

        $roles = [];
        foreach ($this->rbac->review()->getRolesForIDs($group->getAllowedRoles(), false) as $role_data) {
            $roles[] = ilObjRole::_getTranslation($role_data['title']);
        }

        return implode(', ', $roles);
    }

    protected function addActionMenu(Group $group)
    {
        $access = new ilObjUserTakeOverAccess();

        $current_selection_list = new ilAdvancedSelectionListGUI();
        $current_selection_list->setListTitle(self::plugin()->translate('common_actions'));
        $current_selection_list->setId('grp_actions_' . $group->getId());
        $current_selection_list->setUseImages(false);

        self::dic()->ctrl()->setParameterByClass(
            ilUserTakeOverGroupsGUI::class,
            ilUserTakeOverGroupsGUI::PARAM_GROUP_ID,
            $group->getId()
        );
        self::dic()->ctrl()->setParameterByClass(
            ilUserTakeOverMembersGUI::class,
            ilUserTakeOverGroupsGUI::PARAM_GROUP_ID,
            $group->getId()
        );
        if ($access::hasWriteAccess()) {
            $current_selection_list->addItem(
                self::plugin()->translate('edit_members'),
                ilUserTakeOverMembersGUI::CMD_CONFIGURE,
                self::dic()->ctrl()->getLinkTargetByClass(
                    [ilUserTakeOverMainGUI::class, ilUserTakeOverMembersGUI::class],
                    ilUserTakeOverMembersGUI::CMD_CONFIGURE
                )
            );

            $current_selection_list->addItem(
                self::plugin()->translate('edit_grp'),
                ilUserTakeOverGroupsGUI::CMD_EDIT,
                self::dic()->ctrl()->getLinkTargetByClass(
                    [ilUserTakeOverMainGUI::class, ilUserTakeOverGroupsGUI::class],
                    ilUserTakeOverGroupsGUI::CMD_EDIT
                )
            );
        }
        if ($access::hasDeleteAccess()) {
            $current_selection_list->addItem(
                self::plugin()->translate('delete'),
                ilUserTakeOverGroupsGUI::CMD_DELETE,
                self::dic()->ctrl()->getLinkTargetByClass(
                    [ilUserTakeOverMainGUI::class, ilUserTakeOverGroupsGUI::class],
                    ilUserTakeOverGroupsGUI::CMD_CONFIRM
                )
            );
        }
        $current_selection_list->getHTML();
        $this->tpl->setVariable('ACTIONS', $current_selection_list->getHTML());
    }

    protected function parseData()
    {
        $this->determineOffsetAndOrder();
        $this->determineLimit();

        $query_string = "SELECT g.id, count(m.id) AS count FROM ui_uihk_usrto_grp AS g LEFT JOIN ui_uihk_usrto_member AS m ON g.id = m.group_id";

        $sorting_column = $this->getOrderField() ? $this->getOrderField() : 'title';
        $offset = $this->getOffset() ? $this->getOffset() : 0;

        $sorting_direction = $this->getOrderDirection();
        $num = $this->getLimit();

        foreach ($this->filter as $filter_key => $filter_value) {
            switch ($filter_key) {
                case 'title':
                    $query_string .= " WHERE " . self::dic()->database()->like(
                            'g.title',
                            'text',
                            strtolower('%' . $filter_value . '%'),
                            false
                        );
                    break;
                case 'number_of_members':
                    $query_string .= " GROUP BY (g.id) HAVING count >=" . self::dic()->database()->quote(
                            $filter_value,
                            "integer"
                        );
                    break;
            }
        }
        $query_string .= " ORDER BY " . $sorting_column . " " . $sorting_direction . " LIMIT " . self::dic()->database(
            )->quote($offset, "integer")
            . ", " . self::dic()->database()->quote($num, "integer");
        $set = self::dic()->database()->query($query_string);
        while ($row = self::dic()->database()->fetchAssoc($set)) {
            $res[] = $row;
        }
        $this->setData($res);
    }
}
