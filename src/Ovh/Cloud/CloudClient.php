<?php
/**
 * Copyright 2013 Stéphane Depierrepont (aka Toorop)
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * A copy of the License is located at
 *
 * http://www.apache.org/licenses/LICENSE-2.0.txt
 *
 * or in the "license" file accompanying this file. This file is distributed
 * on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

namespace ovh\Cloud;

use Ovh\Common\AbstractClient;
use Ovh\Common\Exception\BadMethodCallException;
use Ovh\Cloud\Exception\CloudException;


class CloudClient extends AbstractClient
{

    /**
     * Get PCA services associated with this cloud passport
     *
     * @param string $pp OVH cloud passport
     * @return string (json encoded array)
     * @throws \Ovh\Cloud\Exception\CloudException
     * @throws \Ovh\Common\Exception\BadMethodCallException
     */
    public function getPcaServices($pp)
    {
        if (!$pp)
            throw new BadMethodCallException('Missing parameter $pp (passport).');
        try {
            $r = $this->get('cloud/' . $pp . '/pca')->send();
        } catch (\Exception $e) {
            throw new CloudException($e->getMessage(), $e->getCode(), $e);
        }
        return $r->getBody(true);
    }


    /**
     * Return properties of PCA $pca service name
     *
     * @param string $pp OVH cloud passport
     * @param string $pca PCA service name
     * @return string (Json encode object)
     * @throws \Ovh\Cloud\Exception\CloudException
     * @throws \Ovh\Common\Exception\BadMethodCallException
     */
    public function getPcaProperties($pp, $pca)
    {
        if (!$pp)
            throw new BadMethodCallException('Missing parameter $pp (passport).');
        if (!$pca)
            throw new BadMethodCallException('Missing parameter $pca (PCAS erviceName).');
        try {
            $r = $this->get('cloud/' . $pp . '/pca/' . $pca)->send();
        } catch (\Exception $e) {
            throw new CloudException($e->getMessage(), $e->getCode(), $e);
        }
        return $r->getBody(true);
    }

    /**
     * Set a SSH public key to PCA
     *
     * @param string $pp OVH cloud passport
     * @param string $pca PCA service name
     * @param string $key
     * @throws \Ovh\Cloud\Exception\CloudException
     * @throws \Ovh\Common\Exception\BadMethodCallException
     */
    public function setSshKey($pp, $pca, $key)
    {
        if (!$pp)
            throw new BadMethodCallException('Missing parameter $pp (OVH cloud passport).');
        if (!$pca)
            throw new BadMethodCallException('Missing parameter $pca (PCA ServiceName).');
        if (!$key)
            throw new BadMethodCallException('Missing parameter $key (Public key for this pca).');
        $payload = array('sshkey' => $key);
        try {
            $this->put('cloud/' . $pp . '/pca/' . $pca, array('Content-Type' => 'application/json;charset=UTF-8'), json_encode($payload))->send();
        } catch (\Exception $e) {
            throw new CloudException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Set password to PCA
     *
     * @param string $pp OVH cloud passport
     * @param string $pca PCA service name
     * @param string $passwd
     * @throws \Ovh\Cloud\Exception\CloudException
     * @throws \Ovh\Common\Exception\BadMethodCallException
     */
    public function setPassword($pp, $pca, $passwd)
    {
        if (!$pp)
            throw new BadMethodCallException('Missing parameter $pp (OVH cloud passport).');
        if (!$pca)
            throw new BadMethodCallException('Missing parameter $pca (PCA ServiceName).');
        if (!$passwd)
            throw new BadMethodCallException('Missing parameter $passwd (Password for this pca).');
        $payload = array('password' => $passwd);
        try {
            $this->put('cloud/' . $pp . '/pca/' . $pca, array('Content-Type' => 'application/json;charset=UTF-8'), json_encode($payload))->send();
        } catch (\Exception $e) {
            throw new CloudException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param string $pp OVH cloud passport
     * @param string $pca PCA service name
     * @return string (json encoded object)
     * @throws \Ovh\Cloud\Exception\CloudException
     * @throws \Ovh\Common\Exception\BadMethodCallException
     */
    public function getPcaInfo($pp, $pca)
    {
        if (!$pp)
            throw new BadMethodCallException('Missing parameter $pp (OVH cloud passport).');
        if (!$pca)
            throw new BadMethodCallException('Missing parameter $pca (PCA ServiceName).');
        try {
            $r = $this->get('cloud/' . $pp . '/pca/' . $pca . '/serviceInfos')->send();
        } catch (\Exception $e) {
            throw new CloudException($e->getMessage(), $e->getCode(), $e);
        }
        return $r->getBody(true);
    }

    /**
     * @param string $pp OVH cloud passport
     * @param string $pca PCA service name
     * @return string (json encoded array)
     * @throws \Ovh\Cloud\Exception\CloudException
     * @throws \Ovh\Common\Exception\BadMethodCallException
     */
    public function getPcaSessions($pp, $pca)
    {
        if (!$pp)
            throw new BadMethodCallException('Missing parameter $pp (OVH cloud passport).');
        if (!$pca)
            throw new BadMethodCallException('Missing parameter $pca (PCA ServiceName).');
        try {
            $r = $this->get('cloud/' . $pp . '/pca/' . $pca . '/sessions')->send();
        } catch (\Exception $e) {
            throw new CloudException($e->getMessage(), $e->getCode(), $e);
        }
        return $r->getBody(true);
    }

    /**
     * @param string $pp OVH cloud passport
     * @param string $pca PCA service name
     * @param string $sessId PCA service name
     * @return string (json encoded object)
     * @throws \Ovh\Cloud\Exception\CloudException
     * @throws \Ovh\Common\Exception\BadMethodCallException
     */
    public function getPcaSessionProperties($pp, $pca, $sessId)
    {
        if (!$pp)
            throw new BadMethodCallException('Missing parameter $pp (OVH cloud passport).');
        if (!$pca)
            throw new BadMethodCallException('Missing parameter $pca (PCA ServiceName).');
        if (!$sessId)
            throw new BadMethodCallException('Missing parameter $sessId (PCA Session ID).');
        try {
            $r = $this->get('cloud/' . $pp . '/pca/' . $pca . '/sessions/' . $sessId)->send();
        } catch (\Exception $e) {
            throw new CloudException($e->getMessage(), $e->getCode(), $e);
        }
        return $r->getBody(true);
    }

    /**
     * @param string $pp OVH cloud passport
     * @param string $pca PCA service name
     * @param string $sessId PCA service name
     * @return string (json encoded array)
     * @throws \Ovh\Cloud\Exception\CloudException
     * @throws \Ovh\Common\Exception\BadMethodCallException
     */
    public function getPcaSessionFiles($pp, $pca, $sessId)
    {
        if (!$pp)
            throw new BadMethodCallException('Missing parameter $pp (OVH cloud passport).');
        if (!$pca)
            throw new BadMethodCallException('Missing parameter $pca (PCA ServiceName).');
        if (!$sessId)
            throw new BadMethodCallException('Missing parameter $sessId (PCA Session ID).');
        try {
            $r = $this->get('cloud/' . $pp . '/pca/' . $pca . '/sessions/' . $sessId . '/files')->send();
        } catch (\Exception $e) {
            throw new CloudException($e->getMessage(), $e->getCode(), $e);
        }
        return $r->getBody(true);
    }

    /**
     * @param string $pp OVH cloud passport
     * @param string $pca PCA service name
     * @param string $sessId PCA service name
     * @param string $fileId PCA service name
     * @return string (json encoded array)
     * @throws \Ovh\Cloud\Exception\CloudException
     * @throws \Ovh\Common\Exception\BadMethodCallException
     */
    public function getPcaSessionFilesProperties($pp, $pca, $sessId, $fileId)
    {
        if (!$pp)
            throw new BadMethodCallException('Missing parameter $pp (OVH cloud passport).');
        if (!$pca)
            throw new BadMethodCallException('Missing parameter $pca (PCA ServiceName).');
        if (!$sessId)
            throw new BadMethodCallException('Missing parameter $sessId (PCA Session ID).');
        if (!$fileId)
            throw new BadMethodCallException('Missing parameter $fileId (file ID).');
        try {
            $r = $this->get('cloud/' . $pp . '/pca/' . $pca . '/sessions/' . $sessId . '/files/' . $fileId)->send();
        } catch (\Exception $e) {
            throw new CloudException($e->getMessage(), $e->getCode(), $e);
        }
        return $r->getBody(true);
    }

    /**
     * @param string $pp OVH cloud passport
     * @param string $pca PCA service name
     * @return string json encoded array)
     * @throws \Ovh\Cloud\Exception\CloudException
     * @throws \Ovh\Common\Exception\BadMethodCallException
     */
    public function getPcaTasks($pp, $pca)
    {
        if (!$pp)
            throw new BadMethodCallException('Missing parameter $pp (OVH cloud passport).');
        if (!$pca)
            throw new BadMethodCallException('Missing parameter $pca (PCA ServiceName).');
        try {
            $r = $this->get('cloud/' . $pp . '/pca/' . $pca . '/tasks')->send();
        } catch (\Exception $e) {
            throw new CloudException($e->getMessage(), $e->getCode(), $e);
        }
        return $r->getBody(true);
    }


    /**
     * @param string $pp OVH cloud passport
     * @param string $pca PCA service name
     * @param string $task task to add
     * @return string json encoded array)
     * @throws \Ovh\Cloud\Exception\CloudException
     * @throws \Ovh\Common\Exception\BadMethodCallException
     */
    public function addPcaTaskProperties($pp, $pca, $task)
    {
        if (!$pp)
            throw new BadMethodCallException('Missing parameter $pp (OVH cloud passport).');
        if (!$pca)
            throw new BadMethodCallException('Missing parameter $pca (PCA ServiceName).');
        if (!$task)
            throw new BadMethodCallException('Missing parameter $task (array task to add).');
        if (!is_array($task))
            throw new BadMethodCallException('Parameter $task must be an array.');
        // clean array
        $requiredKeys = array('sessionId', 'taskFunction', 'fileIds');
        foreach ($task as $k => $v) {
            if (!in_array($k, $requiredKeys)) {
                unset($task[$k]);
            }
        }
        if (count($task) != 3)
            throw new BadMethodCallException("Parameter $task must be a array 'sessionId', 'taskFunction', 'fileIds'");
        // taskFunction ?
        if (!in_array($task['taskFunction'], array('restore', 'delete')))
            throw new BadMethodCallException('Parameter $task[\'taskFunction\'] must be "restore" or "delete". ' . $task['taskFunction'] . ' given.');
        // fileIds
        if (!is_array($task['fileIds']))
            throw new BadMethodCallException('Parameter $task[\'fileIds\'] must a array of fileId. ' . gettype($task['taskFunction']) . ' given.');
        try {
            $r = $this->post('cloud/' . $pp . '/pca/' . $pca . '/tasks', array('Content-Type' => 'application/json;charset=UTF-8'), json_encode($task))->send();
        } catch (\Exception $e) {
            throw new CloudException($e->getMessage(), $e->getCode(), $e);
        }
        return $r->getBody(true);
    }

    /**
     * @param string $pp OVH cloud passport
     * @param string $pca PCA service name
     * @param string $taskId task ID
     * @return string json encoded array)
     * @throws \Ovh\Cloud\Exception\CloudException
     * @throws \Ovh\Common\Exception\BadMethodCallException
     */
    public function getPcaTaskProperties($pp, $pca, $taskId)
    {
        if (!$pp)
            throw new BadMethodCallException('Missing parameter $pp (OVH cloud passport).');
        if (!$pca)
            throw new BadMethodCallException('Missing parameter $pca (PCA ServiceName).');
        if (!$taskId)
            throw new BadMethodCallException('Missing parameter $taskId (ID of the tasks).');
        try {
            $r = $this->get('cloud/' . $pp . '/pca/' . $pca . '/tasks/' . $taskId)->send();
        } catch (\Exception $e) {
            throw new CloudException($e->getMessage(), $e->getCode(), $e);
        }
        return $r->getBody(true);
    }

    /**
     * @param string $pp OVH cloud passport
     * @param string $pca PCA service name
     * @return string json encoded array)
     * @throws \Ovh\Cloud\Exception\CloudException
     * @throws \Ovh\Common\Exception\BadMethodCallException
     */
    public function getPcaUsage($pp, $pca)
    {
        if (!$pp)
            throw new BadMethodCallException('Missing parameter $pp (OVH cloud passport).');
        if (!$pca)
            throw new BadMethodCallException('Missing parameter $pca (PCA ServiceName).');
        try {
            $r = $this->get('cloud/' . $pp . '/pca/' . $pca . '/usage')->send();
        } catch (\Exception $e) {
            throw new CloudException($e->getMessage(), $e->getCode(), $e);
        }
        return $r->getBody(true);
    }


}