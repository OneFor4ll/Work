<?
class ReportModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getProjectReportsPaginated($limit, $offset) {
        $this->db->select('projects.project_id, projects.name as project_name, COUNT(project_allocation.entity_id) as num_people');
        $this->db->from('projects');
        $this->db->join('project_allocation', 'projects.project_id = project_allocation.project_id', 'left');
        $this->db->group_by('projects.project_id, projects.name');
        $this->db->limit($limit, $offset);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getPersonReportsPaginated($limit, $offset) {
        $this->db->select('project_allocation.entity_id, entities.name AS entity_name, projects.name AS project_name, project_allocation.hours_per_month, project_allocation.monthly_cost');
        $this->db->from('project_allocation');
        $this->db->join('entities', 'project_allocation.entity_id = entities.entity_id');
        $this->db->join('projects', 'project_allocation.project_id = projects.project_id');
        $this->db->limit($limit, $offset);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getProjectReportsCount() {
        $query = $this->db->get('projects');
        return $query->num_rows();
    }

    public function getPersonReportsCount() {
        $query = $this->db->get('project_allocation');
        return $query->num_rows();
    }
}
