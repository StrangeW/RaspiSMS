<?php
	namespace models;
	/**
     * Cette classe gère les accès bdd pour les eventes
	 */
	class Events extends \Model
    {
        /**
         * Retourne une entrée par son id
         * @param int $id : L'id de l'entrée
         * @return array : L'entrée
         */
        public function get_by_id ($id)
        {
            $events = $this->getFromTableWhere('events', ['id' => $id]);
            return isset($events[0]) ? $events[0] : false;
        }

		/**
		 * Retourne une liste de eventes sous forme d'un tableau
         * @param int $limit : Nombre de résultat maximum à retourner
         * @param int $offset : Nombre de résultat à ingnorer
		 */
		public function get_list ($limit, $offset)
        {
            $events = $this->getFromTableWhere('events', [], '', false, $limit, $offset);

	    	return $events;
		}

        /**
         * Cette fonction retourne les X dernières entrées triées par date
         * @return array : Les dernières entrées
         */
        public function get_lasts_by_date ($nb_entry)
        {
            $events = $this->getFromTableWhere('events', [], 'at', true, $nb_entry);
            return $events;
        }
        
        /**
		 * Retourne une liste de eventes sous forme d'un tableau
         * @param array $ids : un ou plusieurs id d'entrées à récupérer
         * @return array : La liste des entrées
		 */
        public function get_by_ids ($ids)
        {
			$query = " 
                SELECT * FROM events
                WHERE id ";
     
            //On génère la clause IN et les paramètres adaptés depuis le tableau des id 
            $generated_in = $this->generateInFromArray($ids);
            $query .= $generated_in['QUERY'];
            $params = $generated_in['PARAMS'];

            return $this->runQuery($query, $params);
        }
        
        /**
		 * Retourne une liste de eventes sous forme d'un tableau
         * @param array $ids : un ou plusieurs id d'entrées à supprimer
         * @return int : Le nombre de lignes supprimées
		 */
        public function delete_by_ids ($ids)
        {
			$query = " 
                DELETE FROM events
                WHERE id ";
     
            //On génère la clause IN et les paramètres adaptés depuis le tableau des id 
            $generated_in = $this->generateInFromArray($ids);
            $query .= $generated_in['QUERY'];
            $params = $generated_in['PARAMS'];

            return $this->runQuery($query, $params, self::ROWCOUNT);
        }

        /**
         * Insert une evente
         * @param array $event : La evente à insérer avec les champs name, script, admin & admin
         * @return mixed bool|int : false si echec, sinon l'id de la nouvelle lignée insérée
         */
        public function insert ($event)
        {
            $result = $this->insertIntoTable('events', $event);

            if (!$result)
            {
                return false;
            }

            return $this->lastId();
        }

        /**
         * Compte le nombre d'entrées dans la table
         * @return int : Le nombre d'entrées
         */
        public function count ()
        {
            return $this->countTable('events');
        }

    }
