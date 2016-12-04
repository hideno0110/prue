#!/bin/bash

# git diffシェルスクリプトの使い方
# terminalで git diff --name-only コミット番号　を入力すると差分のファイルをすべて取得してコピーする（上書き含む）
# 使用する前には、git cat コマンドを一度コメントアウトして動作を確認したほうがよい。
# なお、terminalで入力したものがfileに格納されそれ一行一行実行していくような形です。

cmd="`git diff --name-only $1`"
for file in $cmd
do
  echo "git cat-file -p $1:$file > $file"
  git cat-file -p $1:$file > $file
  echo $file
done





