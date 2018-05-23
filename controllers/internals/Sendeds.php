<?php
namespace controllers\internals;
	/**
	 * Classe des sendedes
	 */
	class Sendeds extends \InternalController
	{

		/**
         * Cette fonction retourne une liste des sendedes sous forme d'un tableau
         * @param mixed(int|bool) $nb_entry : Le nombre d'entrées à retourner par page
         * @param mixed(int|bool) $page : Le numéro de page en cours
         * @return array : La liste des sendedes
         */	
		public function get_list ($nb_entry = false, $page = false)
		{
			//Recupération des sendedes
            $modelSendeds = new \models\Sendeds($this->bdd);
            return $modelSendeds->get_list($nb_entry, $nb_entry * $page);
		}

		/**
         * Cette fonction retourne une liste des sendedes sous forme d'un tableau
         * @param array int $ids : Les ids des entrées à retourner
         * @return array : La liste des sendedes
         */	
		public function get_by_ids ($ids)
		{
			//Recupération des sendedes
            $modelSendeds = new \models\Sendeds($this->bdd);
            return $modelSendeds->get_by_ids($ids);
        }

        /**
         * Cette fonction retourne les X dernières entrées triées par date
         * @param mixed false|int $nb_entry : Nombre d'entrée à retourner ou faux pour tout
         * @return array : Les dernières entrées
         */
        public function get_lasts_by_date ($nb_entry = false)
        {
            $modelSendeds = new \models\Sendeds($this->bdd);
            return $modelSendeds->get_lasts_by_date($nb_entry);
        }
        
        /**
         * Cette fonction retourne une liste des receivedes sous forme d'un tableau
         * @param string $target : Le numéro de à qui est envoyé le message
         * @return array : La liste des sendeds
         */	
		public function get_by_target ($target)
		{
			//Recupération des sendeds
            $modelSendeds = new \models\Sendeds($this->bdd);
            return $modelSendeds->get_by_target($target);
        }


		/**
		 * Cette fonction va supprimer une liste de sendeds
		 * @param array $ids : Les id des sendedes à supprimer
		 * @return int : Le nombre de sendedes supprimées;
		 */
		public function delete ($ids)
        {
            $modelSendeds = new \models\Sendeds($this->bdd);
            return $modelSendeds->delete_by_ids($ids);
		}

		/**
         * Cette fonction insert une nouvelle sendede
         * @param array $sended : Un tableau représentant la sendede à insérer
         * @return mixed bool|int : false si echec, sinon l'id de la nouvelle sendede insérée
		 */
        public function create ($sended)
		{
            $modelSendeds = new \models\Sendeds($this->bdd);
            return $modelSendeds->create($sended);
		}

		/**
         * Cette fonction met à jour une série de sendedes
         * @return int : le nombre de ligne modifiées
		 */
		public function update ($sendeds)
        {
            $modelSendeds = new \models\Sendeds($this->bdd);
            
            $nb_update = 0;
            foreach ($sendeds as $sended)
            {
                $result = $modelSendeds->update($sended['id'], $sended);

                if ($result)
                {
                    $nb_update ++;
                }
            }
        
            return $nb_update;
        }
        
        /**
         * Cette fonction permet de compter le nombre de sendeds
         * @return int : Le nombre d'entrées dans la table
         */
        public function count ()
        {
            $modelSendeds = new \models\Sendeds($this->bdd);
            return $modelSendeds->count();
        }

        /**
         * Cette fonction compte le nombre de sendeds par jour depuis une date
         * @return array : un tableau avec en clef la date et en valeure le nombre de sms envoyés
         */
        public function count_by_day_since ($date)
        {
            $modelSendeds = new \models\Sendeds($this->bdd);

            $counts_by_day = $modelSendeds->count_by_day_since($date);
            $return = [];
            
            foreach ($counts_by_day as $count_by_day)
            {
                $return[$count_by_day['at_ymd']] = $count_by_day['nb'];
            }

            return $return;
        }
	}
